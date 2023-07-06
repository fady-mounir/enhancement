<?php

namespace App\Helpers;

use App\Jobs\sendEmail;
use App\User;
use Illuminate\Support\Facades\Mail;

class utility
{

    public static function get_admins($ids_only = false)
    {
        $admins = User::getAdmins();

        if ($ids_only) {
            return $admins->pluck("user_id")->all();
        }

        return $admins;
    }

    public static function updateEnvFile(array $array)
    {

        $envFile = app()->environmentFilePath();
        $str     = file_get_contents($envFile);

        if (is_array($array) && count($array) > 0) {
            foreach ($array as $envKey => $envValue) {

                $str               .= "\n"; // In case the searched variable is in the last line without \n
                $keyPosition       = strpos($str, "{$envKey}=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine           = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                // If key does not exist, add it
                if (is_bool($keyPosition) && (!$keyPosition || !$endOfLinePosition || !$oldLine)) {
                    $str .= "{$envKey}={$envValue}\n";
                }
                else {
                    $str = str_replace($oldLine, "{$envKey}={$envValue}", $str);
                }

            }
        }

        $str = substr($str, 0, -1);
        file_put_contents($envFile, $str);

    }

    public static function sendEmailToCustom(
        $emails = [],
        $data = "",
        $subject = "",
        $sender = "",
        $path_to_file = "",
        $name = "",
        $reply_to = "",
        $reply_to_name = ""
    )
    {

        if (is_array($emails) && count($emails) > 0) {
            $emails = array_diff($emails, [""]);


            if (is_array($data) && count($data) > 0) {
                $view = "email.advanced";
            }
            else {
                $data = ["default" => $data];
                $view = "email.default";
            }

            Mail::send($view, $data, function ($message) use (
                $emails, $subject, $path_to_file, $name, $reply_to, $reply_to_name
            ) {


                if ($reply_to != "" & $reply_to_name != "") {
                    $message->replyTo($reply_to, $reply_to_name);
                }


                if ($path_to_file != "" && is_file($path_to_file)) {
                    $message->attach($path_to_file);
                }

                if (count($emails) > 1)
                {
                    $message->bcc($emails)->subject($subject);
                }
                else{
                    $message->to($emails[0])->subject($subject);
                }

            });

        }

        return Mail:: failures();
    }

    public static function sendErrorLogEmail($subject, $body, $requestLog = [])
    {


        $user_email_body = \View::make("email.system.bug_email")->with([
            "header"  => $subject,
            "message" => $body,
            "getLog"  => $requestLog,
        ])->render();

        dispatch(
            (new sendEmail([
                "email"   => config('system_emails.developers'),
                "subject" => $subject,
                "data"    => $user_email_body
            ]))->onQueue("not_important_queue")
        );


    }

}

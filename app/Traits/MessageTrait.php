<?php

namespace App\Traits;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Notification;
use App\Notifications\NewsletterNotification;
use App\Notifications\DeleteNotification;
use App\Notifications\ContactUsNotification;

trait MessageTrait
{
    public function contactSend($datos){
      $email=$datos->email;
      $contact_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Contact '.$datos['name'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You sended succefully this contact message to: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get($datos['mensage']),
                       'newsText1' => Lang::get('You go to receive very soon an answare.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactUsNotification($newsData));
    }

    public function contactTunDaapoSend($datos, $company_email){
      $email=$company_email;
      $contact_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Contact '.$datos['name'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You are receiving a new contact email with content: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get($datos['mensage']),
                       'newsText1' => Lang::get('Please, send an answare as soon like is possible for you.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactUsNotification($newsData));
    }

    public function budgetSend($datos){
      $email=$datos->email;
      $budget_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Ask for Budget '.$datos['name_or_company'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You sended succefully this contact message to: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get(config('app.name').' will schedule an appointment with you.'),
                       'newsText1' => Lang::get('You go to receive very soon an answare.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactUsNotification($newsData));
    }

    public function budgetTunDaapoSend($datos, $company_email){
      $email=$company_email;
      $budget_id=$datos->id;

                $newsData = [
                       'name' => Lang::get('Request Ask for Budget '.$datos['name_or_company'].' ,email: '.$datos['email']),
                       'email'=>$email,
                       'body' => Lang::get('You are receiving a new contact email with content: '),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get(' send an shedule appoinment to the company or person'),
                       'newsText1' => Lang::get('Please, they will be waiting an email as soon like be possible for you.')
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new ContactUsNotification($newsData));
    }

    public function newsletterSend($suscripcion){

      $email=$suscripcion->email;
      $suscripcion_id=$suscripcion->id;

      $url=url(route('unsubscribe',['suscriptor'=>$suscripcion_id]));
      $newsletter_id=$suscripcion_id;
      $data=['url'=>$url,'email'=>$email];

                $newsData = [
                       'name' => $email,
                       'email'=>$email,
                       'body' => Lang::get('Thank you for subscribe!'),
                       'thanks' => Lang::get('Greetings, '. config('app.name')),
                       'newsText' => Lang::get('If you did not subscribe link this url for unsubscribe'),
                       'newsUrl' => $url,
                       'action_text'=> Lang::get('Unsubscribe'),
                       'newsletter_id' => $newsletter_id
                   ];

                   Notification::route('mail', $email)
                                 ->notify(new NewsletterNotification($newsData));

                   dd('Task completed!');
    }
}

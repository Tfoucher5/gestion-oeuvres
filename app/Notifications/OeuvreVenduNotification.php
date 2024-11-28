<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class OeuvreVenduNotification extends Notification
{
    use Queueable;

    protected $oeuvre;
    protected $prixVente;

    /**
     * Create a new notification instance.
     *
     * @param $oeuvre
     * @param $prixVente
     */
    public function __construct($oeuvre, $prixVente)
    {
        $this->oeuvre = $oeuvre;
        $this->prixVente = $prixVente;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // La notification sera envoyée par email
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new \Illuminate\Notifications\Messages\MailMessage)
            ->subject('Votre œuvre a été vendue !')
            ->greeting('Bonjour ' . $notifiable->prenom . ' ' . $notifiable->nom)
            ->line("Votre œuvre intitulée **{$this->oeuvre->nom}** a été vendue.")
            ->line("Prix de vente : **{$this->prixVente} €**.")
            ->line('Merci de nous faire confiance.');
    }
}
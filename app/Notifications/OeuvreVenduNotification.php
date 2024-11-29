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
        return ['mail', 'database']; // La notification sera envoyée par email et stockée dans la base de données
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

    /**
     * Get the database representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'oeuvre_id' => $this->oeuvre->id,
            'oeuvre_nom' => $this->oeuvre->nom,
            'prix_vente' => $this->prixVente,
            'message' => 'Votre œuvre "' . $this->oeuvre->nom . '" a été Vendue pour' . $this->prixVente .'€'
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'oeuvre_id' => $this->oeuvre->id,
            'oeuvre_nom' => $this->oeuvre->nom,
            'prix_vente' => $this->prixVente,
        ];
    }
}

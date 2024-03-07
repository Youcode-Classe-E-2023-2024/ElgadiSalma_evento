<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Billet de réservation</title>
</head>
<body>
    <h1>Billet de réservation</h1>
    {{-- <p>Bienvenue, {{ $reservation->event->createdBy->name }} !</p> --}}
    
    <h2>Détails de l'événement :</h2>
    <p>Nom de l'événement : {{ $event->title }}</p>
    <p>Date et heure : {{ $event->deadline }}</p>
    <!-- Autres détails de l'événement -->

    <h2>Informations de réservation :</h2>
    <p>Numéro de réservation : {{ $reservation->id }}</p>
    <!-- Autres détails de la réservation -->

    <p>Merci pour votre réservation !</p>
</body>
</html>

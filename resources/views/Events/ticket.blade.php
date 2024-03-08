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
    <h2>{{ $event->category->name }}</h2>
    <p>Nom de l'événement : {{ $event->title }}</p>
    <p>Date : {{ $event->deadline }}</p>
    <p>{{ $event->city->ville }}</p>

    <h2>Informations de réservation :</h2>
    <p><span>Numéro de réservation :</span> {{ $reservation->id }}</p>
    <!-- Autres détails de la réservation -->

    <p>Merci pour votre réservation !</p>
</body>
</html>


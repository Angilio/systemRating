@component('mail::message')
# Bonjour {{ $user->name }} {{ $user->prenoms }},

Votre compte étudiant a été créé avec succès.

Voici vos informations de connexion :

- **Email :** {{ $user->email }}
- **Mot de passe :** `{{ $motDePasse }}`

@component('mail::button', ['url' => route('login')])
Se connecter
@endcomponent

Merci de bien vouloir changer votre mot de passe après votre première connexion.

Cordialement,  
L'équipe administrative.
@endcomponent

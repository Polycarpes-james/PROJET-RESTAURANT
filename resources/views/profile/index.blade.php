@extends('layout.base')

@section('title', "Mon compte")
@section('main-style', 'profile-main-container')
@section('body-style', 'profile-style')

@section('background_header', 'profile-backgroud-header')

@php
   $profileData = [
        'user' => Auth::user(),
        'role' => Auth::user()->role_label,
        'profile' => $profile ?? null,
        'panier' => $panier ?? [],
        'plats' => $panier->plats,
        'total' => $total ?? 0,
        'image' => image_url(Auth::user()->avatar, 300, 300)
    ];

    $commandeUserProfileData = [
        'commande' => $commande,
        'plats' => $platsCommande,
    ];
    
 $fields = [
        [
            'name' => 'name',
            'value' => Auth::user()->name,
            'label' => 'Mon nom de profile',
        ],
        [
            'name' => 'firstname',
            'value' => Auth::user()->firstname,
            'label' => 'Mon prenom de profile',
        ],
        [
            'name' => 'email',
            'value' => Auth::user()->email,
            'label' => 'Mon adresse email',
        ],
        [
            'name' => 'phone_number',
            'value' => Auth::user()->phone_number,
            'label' => 'Mon numero de telephone',
        ],
    ];

    $route = request()->route()->getName();
@endphp

@section('content')
    <div id="app"></div>
   <script>
    window.profileData = @json($profileData);
    window.commandeUserProfileData = @json($commandeUserProfileData);
</script>
@endsection




    
{{-- 

import pypandoc

content = r"""
# Liste des icônes Lucide React

## Utilisateur / Profil
User, Users, UserRound, CircleUser, UserCircle, UserPlus, UserMinus, UserCheck, UserX, Contact, ContactRound, BadgeUser

## Navigation / Général
House, Home, Menu, X, ChevronDown, ChevronUp, ChevronLeft, ChevronRight, ArrowLeft, ArrowRight, ArrowUp, ArrowDown, Plus, Minus, Check, CheckCircle, Circle, Info, AlertCircle, AlertTriangle, HelpCircle

## Commerce / Restaurant / Panier
ShoppingCart, ShoppingBag, ShoppingBasket, Store, ChefHat, Utensils, UtensilsCrossed, Coffee, Pizza, Cake, Cookie, Soup, Wine, CupSoda, Package, Box, Truck, Receipt, WalletCards, CreditCard, BadgeDollarSign, DollarSign, Euro

## Cuisine
ChefHat, CookingPot, Cooking, Soup, Salad, Utensils, UtensilsCrossed, Flame, Wheat, Apple, Cherry, Beef, Fish, Egg, Milk, Wine

## Adresse / Localisation
MapPin, Map, Navigation, Compass, Globe, Locate, LocateFixed, Route, Building, Building2, House

## Contact
Mail, MailOpen, Send, Phone, PhoneCall, MessageCircle, MessageSquare, MessagesSquare, AtSign

## Recherche / Filtre
Search, Filter, SlidersHorizontal, ListFilter, ScanSearch, ZoomIn, ZoomOut

## Paramètres
Settings, Settings2, Cog, Wrench, Tool, Sliders

## Modification / Actions
Edit, Pencil, PencilLine, Trash, Trash2, Save, Copy, Clipboard, Download, Upload, Share, ExternalLink, Link, Eye, EyeOff, Lock, Unlock

## Images / Médias
Image, Images, Camera, CameraOff, Video, Film, Play, Pause, Mic, Volume, Volume2, Music

## Favoris / Réactions
Heart, HeartHandshake, Star, Bookmark, ThumbsUp, ThumbsDown, Smile, Frown

## Temps / Date
Calendar, CalendarDays, Clock, Timer, History, Hourglass, AlarmClock

## Sécurité
Lock, Unlock, Shield, ShieldCheck, ShieldAlert, Key, Fingerprint, ScanFace

## Dashboard / Administration
LayoutDashboard, ChartBar, ChartLine, ChartPie, TrendingUp, TrendingDown, Activity, Database, Server, FileText, Folder, FolderOpen

## Fichiers
File, FileText, FileImage, FilePlus, FileMinus, Folder, FolderPlus, FolderMinus, Archive, Paperclip

## Commande / Livraison
Truck, Package, PackageCheck, PackageOpen, PackageX, MapPin, Navigation, Receipt, ClipboardList

## Icônes recommandées pour ProfilePage
CircleUser, Mail, Phone, MapPin, ShoppingCart, ChefHat, Settings, Pencil, Camera, Lock, Calendar
"""

path = "/mnt/data/lucide-react-icons.md"
pypandoc.convert_text(
    content,
    'md',
    format='md',
    outputfile=path,
    extra_args=['--standalone']
)

path
--}}
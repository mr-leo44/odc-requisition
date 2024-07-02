<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{('index.css' )}}" type="text/css">
  
    
</head>
<body>
    <nav>
        <p class="flotte">
            <img src="img/orange.png" alt="">
            <div class="txt">
                <p>372, av. Colonel Mondjiba</p>
                <div class="col">
                    <p>Commune de Ngaliema</p>
                </div>
                <div class="Kin">
                    <p>Kinshasa</p>
                </div>
            </div>
        </p>
    </nav>
    <p class="adr">Kinsaha, le...../...../......</p>
    <h1>BON DE REQUISITION INTERNE N°</h1>
    <h3>service demandeur :...................................................</h3>
    <table border="1">
            <tr>
                <th class="nom">N°</th>
                <th class="name1">DESIGNATION</th>
                <th class="name">QTE DEMANDEE</th>
                <th class="name">QTE LIVREE</th>
                <th class="name">UTILISATEUR</th>
            </tr>
        @foreach ($pdf->demande_details as $item)
        
            <tr class="items">
                <td> {{$item->id}}</td>
                <td> {{$item->designation}} </td>
                <td> {{$item->qte_demandee}} </td>
                <td>{{$item->qte_livree}} </td>
                <td>{{ $pdf->user->name }}</td>
            </tr>
        @endforeach
    </table>
    <table class="foot">
        <tr>
            <th>Service Demandeur</th>
            <th>Magasin</th>
            <th>responsable Moyens Généraux</th>
            <th>Chef de Département Achat & Logistique</th>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>

        </tr>
    </table>
</body>
</html>
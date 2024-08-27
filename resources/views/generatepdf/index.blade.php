<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="{{ asset('index.css') }}" type="text/css"> -->
    <style>
    .flotte {
        display: flex;
        margin-left: 5px;
        width: 150px;
        height: 100px;
        float: left;
    }

    .txt {
        right: 10%;
        display: inline-block;
        /* margin-top: -250px; */

    }

    .kin {
        right: 10px;
        margin-top: -30px;
        margin-right: -10px;
        margin-bottom: 5px;
    }

    .col {
        right: 10px;
        margin-top: -30px;
    }
    </style>
</head>

<body>
    <nav>
        <p class="flotte">
            <img src="data:image/png;base64,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" style="max-width: 130px; margin-right: 35px; margin-top: 50px;"
                alt="logo">

        </p>
        <div class="txt">
            372, av. Colonel Mondjiba <br>
            Cummune de ngaliema <br>
            kinshasa
        </div>
    </nav>
    <p class="adr">Kinshasa, le {{ date('d/m/Y') }}</p>
    <h1>BON DE REQUISITION INTERNE N° {{ $demande->numero }} </h1>
    <h3>service demandeur : {{ $demande->service}} </h3>
    <table border="1">
        <tr>
            <th class="nom">N°</th>
            <th class="name1">DESIGNATION</th>
            <th class="name">QTE DEMANDEE</th>
            <th class="name">QTE LIVREE</th>
            <th class="name">UTILISATEUR</th>
        </tr>
        @foreach ($demande->demande_details as $key => $item)
        <tr class="items">
            <td class="center"> {{ $key + 1 }}</td>
            <td class="center"> {{ $item->designation }} </td>
            <td class="center"> {{ $item->qte_demandee }} </td>
            <td class="center">{{ $item->qte_livree }} </td>
            <td class="center">{{ $demande->user->name }}</td>
        </tr>
        @endforeach
    </table>
    <table class="foot">
        <tr>
            <!-- <th>Service démandeur</th>
            <th>Magasin</th>
            <th>Responsable moyens généraux</th>
            <th> Chef de département achat & Logistique</th>
            <th colspan="2">Service Demandeur</th> -->
            <!-- @foreach ($traitements as $traitement)
                <th>{{ $traitement->fonction }}</th>
            @endforeach -->
        </tr>
        <tr>
            @foreach ($traitements as $traitement)
                <td>{{ $traitement->approbateur }}</td>
            @endforeach
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <style>
    table {
        table-layout: fixed;
        margin-right: 10px;
        margin-top: 1px;
        margin-left: 5px;
        width: 100%;
        border-collapse: collapse;
    }
    .center{
        text-align: center;
    }

    h1 {
        text-align: center;
        margin-top: 80px;
        font-size: 20px;
        /* margin-left: 25%; */
    }

    h3 {
        margin-left: 120px;
        margin-bottom: 45px;
    }

    .adr {
        margin-left: 40%;
        float: right;
        margin-top: -100px;
        font-size: 15px;
        font-family: 'Times New Roman', Times, serif;

    }

    .foot {
        margin-top: 500px;
    }
    </style>
</body>

</html>
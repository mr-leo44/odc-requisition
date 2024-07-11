<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('index.css') }}" type="text/css">
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
            -
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
            <img src="https://th.bing.com/th/id/R.7322c511099a068f5689584aecf6f3be?rik=BE2S1VvY890%2bxg&riu=http%3a%2f%2fwww.ranklogos.com%2fwp-content%2fuploads%2f2014%2f08%2fOrange-logo-500x500.jpg&ehk=DIaknrKAB5S34NmF1UAY8w657JfVE4N1iyRtVYt1VAs%3d&risl=&pid=ImgRaw&r=0"
                style="max-width: 130px; margin-right: 35px; margin-top: 50px;" alt="">
        </p>
        <div class="txt">
            372, av. Colonel Mondjiba <br>
            Cummune de ngaliema <br>
            kinshasa
        </div>
    </nav>
    <p class="adr">Kinshasa, le {{ date('d/m/Y') }}</p>
    <h1>BON DE REQUISITION INTERNE N° {{ $demande->numero }} </h1>
    <h3>service demandeur : {{ $demande->service->name }}</h3>
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
                <td> {{ $key + 1 }}</td>
                <td> {{ $item->designation }} </td>
                <td> {{ $item->qte_demandee }} </td>
                <td>{{ $item->qte_livree }} </td>
                <td>{{ $demande->user->name }}</td>
            </tr>
        @endforeach
    </table>
    <table class="foot">
        <tr>
            <th colspan="2">Service Demandeur</th>
            @foreach ($approbateurs as $approbateur)
                <th>{{ $approbateur->fonction }}</th>
            @endforeach
        </tr>
        <tr>
            <td>{{ $demande->user->name }}</td>
            <td>{{ $demande->manager }}</td>
            @foreach ($approbateurs as $approbateur)
                <td>{{ $approbateur->name }}</td>
            @endforeach

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

        h1 {
            text-align: center;
            margin-top: 80px;
            font-size: 20px;
            margin-left: 25%;
        }

        h3 {
            margin-left: 180px;
            margin-bottom: 45px;
        }

        .adr {
            margin-left: 40%;
            float: right;
            margin-top: -100px;
            font-size: 15px;
            font-family: 'Times New Roman', Times, serif;

        }
        .foot{
            margin-top: 140px;
        }
    </style>
</body>

</html>

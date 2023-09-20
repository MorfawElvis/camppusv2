<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Cards</title>
    <style>
        * { 
            margin: 0;
            padding: 1px;
            box-sizing: border-box;
        }
       @page {
            size: 8.5cm 5.5cm;  /* width height */
            }
        .page{
            border: 1px solid black;
            margin-bottom: 10px;
        }
        #div1:after{
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            left: 0;
            position: absolute;
            background-image: url("images/images.jpeg");
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center center;
            opacity: 0.1;
        }
        #div2{
            margin-top:4px;
            line-height: 10px;
        }
        #div3{
            float: left;
            margin-left:6px;
        }
        #div4{
            margin-top:18px;
            line-height:12px;
        }
        #logo{
            margin-top:4px;
            width: 40px;
            float: left;
            margin-left:20px;
        }
        #label1{
            font-size: 12px;
            font-weight: bold;
            margin-left: 20px;
            opacity: 0.7;
        }
        #label2{
            color: #150aac;
            font-size: 10px;
            font-weight: bold;
            margin-left: 28px;
        }
        #label3{
            font-weight: bold;
            font-size: 8px;
            margin-left: 38px;
            text-align: center;
        }
        #label4{
            color: #373b3b;
            font-size: 24px;
            font-weight: bold;
        }
        #hr1{
            width: 100%;
            margin-top:4px;
            border: 1px solid black;
            background-color: black;
            height: 1px;
        }
        #hr2{
            width: 100%;
            border: 1px solid black;
            background-color: black;
            margin-top:5px;
            height: 1px;
        }
        #img2{
            width: 280px;
        }
        #img3{
            width: 200px;
            height: 70px;
            margin-left: 8px;
        }
        #label5{
            font-weight: bold;
            font-size: 10px;
            opacity: 0.8;
            margin-left: 6px;
        }
        /* p{
            margin-bottom: 0px;
        } */
        #label8{
            font-size: 25px;
            font-weight: bold;
        }
        #label6{
            font-weight: bolder;
            font-size: 10px;
            margin-left: 20px;
        }
        #name{
            font-weight: bolder;
            font-size: 9px;
        }
        #label7{
            color: #03350b;
            font-weight: bold;
            font-size: 10px;
            margin-left: 6px;
        }
        #label9{
            font-size: 28px;
            font-weight: bold;
            color: #110f0f;
            margin-left: 10px;
        }
        #profile-image{
            width: 80px;
            height: 90px;
            border-radius: 10px 10px 10px 10px;
            margin-top:10px;
        }
        .barcode{
            text-align: center;
        }
        .barcode img{
            width: 80%;
        }
        @media print {
            .page{
                page-break-after: always;
                break-inside: avoid;
                border: 0;
            }
        }
       .signature{
        width: 100px;
       }
        .details-info1{
            text-align: center;
            line-height: 14px;
            margin-top:6px;
            padding: 0;
        }
        .details-info2{
            text-align: center;
            margin-top:4px;
        }
        #hr3{
            width: 100%;
            border: 1px solid black;
            background-color: black;
        }
        #card-type{
            font-size: 10px;
            float:right;
            background-color: #150aac;
            color: white;
        }
        #card-type em{
            padding: 4px;
        }
        #div-back{
            margin-bottom: 4px;
        }
    </style>
</head>
<body>
     <div id="div-back">
          <div class="details-info1">
            <p style="font-size:13px;">The bearer whose photograph appears overleaf is a student of</p>
              <p style="font-size: 14px; color:#150aac;"><b> St. Joseph's College Sasse </b></p>
              <p style="font-size:14px;"><b>Diocese of Buea</b></p>
          </div>
          <hr id="hr3">
          <div class="details-info2">
            <p style="font-size:14px;">Please, if found return to the <span style="font-weight: bolder;">Principal</span></p>
              <img class="signature" src="{{ 'storage/logo/Signature.png' }}">
          </div>
        <div>
            <p style="font-size:11px; color:red; text-align:center;"><label>Expiry Date:</label> <label id="label6">September 2023</label></p>
        </div>
        <hr id="hr3">
    </div> 
    @foreach ($students as $student)
        <div id="div1" class="page">
            <img id="logo" src="{{ asset('storage/logo/school_logo.jpg') }}">
            <div id="div2">
                <label id="label1">ST. JOSEPH'S COLLEGE SASSE</label><br>
                <label id="label2">DIOCESE OF BUEA - CAMEROON</label><br>
                <em id="label3">FIDES - QUARENS - INTELLECTUM</em>
            </div>
            <hr id="hr1">
            <div id="card-type">
                <em>STUDENT IDENTITY CARD</em>
            </div>
            <div id="div3">
                @isset($student->profile_image)
                <img id="profile-image" src="{{ asset('storage/public/students_photos/'.$student->profile_image)}}">
                @endisset
            </div>
            <div id="div4">
                <p><label id="label5">Name:</label> <label id="name">{{ $student->full_name }}</label></p>
                <p><label id="label5">Class: </label> <label id="label6">{{ $student->class_room->class_name}}</label></p>
                <p><label id="label5">Place of Birth:</label> <label id="label6">{{ $student->place_of_birth }}</label></p>
                <p><label id="label5">Date of Birth: </label> <label id="label6">{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d / m / Y') }}</label></p>
                <p><label id="label7">Academic Year:</label> <label id="label7">{{ current_school_year()->year_name }}</label></p>
            </div>
            <hr id="hr2">
            <div class="barcode">
                <img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($student->matriculation, $generator::TYPE_CODE_128)) }}">
            </div>
        </div>
    @endforeach  
</body>
</html>
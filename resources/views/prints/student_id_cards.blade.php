<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Cards</title>
<style>
  *{
    margin: 00px;
    padding: 00px;
    box-sizing: content-box;
}

.container {
    height: 100vh;
    width: 100%;
    align-items: center;
    background-color: #ffff;

}
.font{
    height: 375px;
    width: 250px;
    position: relative;
    border-radius: 10px;
}

.top{
    height: 30%;
    width: 100%;
    background-color: #1559A7;
    position: relative;
    z-index: 5;
    border: solid 1px;
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
}

.bottom{
    height: 70%;
    width: 100%;
    background-color: white;
    position: absolute;
    border: solid 1px;
    border-bottom-left-radius: 15px;
    border-bottom-right-radius: 15px;
}

.top img{
    height: 100px;
    width: 100px;
    background-color: #e6ebe0;
    border-radius: 10px;
    position: absolute;
    top:60px;
    left: 75px;
}
.bottom p{
    position: relative;
    top: 60px;
    text-align: center;
    text-transform: capitalize;
    font-weight: bold;
    font-size: 20px;
    text-emphasis: spacing;
}
.bottom .desi{
    font-size:14px;
    font-weight: 800;
    color: rgb(51, 50, 50);
    font-weight: normal;
}
.bottom .no{
    font-size: 15px;
    font-weight: normal;
}
.barcode img
{
    height: 65px;
    width: 65px;
    text-align: center;
    margin: 5px;
}
.signature{
  height: 100px;
    width: 100px;
}
.barcode{
    text-align: center;
    position: relative;
    top: 70px;
}

.back
{
    height: 375px;
    width: 250px;
    border-radius: 10px;
    border: solid 1px;
}
.qr img{
    height: 80px;
    width: 100%;
    margin: 20px;
    background-color: white;
}
.Details {
    color: black;
    text-align: center;
    padding: 10px;
    font-size: 25px;
}
.details-info{
    color: black;
    text-align: left;
    padding: 5px;
    line-height: 20px;
    font-size: 16px;
    text-align: center;
    margin-top: 2px;
    line-height: 22px;
}
.logo {
    height: 40px;
    width: 150px;
    padding: 30px;
    margin-top:-10px;
    margin-left: 20px;
}
td{
  align-content: center;
}
.logo img{
    height: 100%;
    width: 100%;
    margin-top:-50px;
    color: white ;

}
.padding{
    padding-right: 20px;
}
.center {
  margin-left: auto;
  margin-right: auto;
}
table {
  border-collapse:separate; 
  border-spacing: 0 2em;
}
@media screen and (max-width:400px)
{
    .container{
        height: 130vh;
    }
    .container .front{
        margin-top: 50px;
    }
}
@media screen and (max-width:600px)
{
    .container{
        height: 130vh;
    }
    .container .front{
        margin-top: 50px;
    }

}
@media print {
body {-webkit-print-color-adjust: exact;}
}
@media print {
  tr {
    break-inside: avoid;
  }
}
</style>
</head>
<body>
        <table class="center">
          @foreach ($students as $student)
          <tr>
            <td>
              <div class="padding">
                <div class="font">
                    <div class="top">
                      <p style="text-align: center; color:white; padding-top:10px; font-weight:bold; font-size:15px;">{{ $setting->school_name ?? '' }} </p>
                      <h5 style="text-align: center; color:white;">STUDENT IDENTITY CARD</h5>
                        @isset($student->profile_image)
                        <img src="{{ asset('storage/public/students_photos/'.$student->profile_image)}}">
                        @endisset
                    </div>
                    <div class="bottom">
                        <p style="font-size: 14px;">{{ $student->full_name }}</p>
                        <p class="desi">{{ $student->class_room->class_name}}</p>
                        <div class="barcode">
                            <img src="{{ asset('storage/logo/school_logo.jpg') }}">
                        </div>
                        <br>
                        <p class="no"><strong>Born on:</strong> {{ \Carbon\Carbon::parse($student->date_of_birth)->format('d / m / Y') }}</p>
                        <p class="no"><strong>Place of Birth:</strong> {{ $student->place_of_birth }}</p>
                        <p class="no"><strong>Matriculation:</strong> {{ $student->matriculation }}</p>                  
                    </div>
                </div>
              </div>
            </td>
            <td>
              <div class="back">
                <h1 class="Details">Diocese of Buea</h1>
                <hr class="hr">
                <div class="details-info">
                  <p>The bearer whose photograph appears overleaf is a staff of</p>
                    <p style="font-size: 14px;"><b> {{ $setting->school_name ?? '' }} </b></p><br>
                    <p><b>The Principal</b></p>
                    <img class="signature" src="{{ 'storage/logo/Signature.png' }}">
                </div>
                <div class="logo">
                  <img src="data:image/png;base64,{{ base64_encode($generator->getBarcode($student->matriculation, $generator::TYPE_CODE_128)) }}">
                </div>
                <p style="margin-top: -20px; text-align:center;"><b>Academic Year: {{ $student->class_room->academic_year->year_name }}</b></p>
                <hr>
            </div>
            </td>
      </tr>
          @endforeach
        </table>
</body>
</html>
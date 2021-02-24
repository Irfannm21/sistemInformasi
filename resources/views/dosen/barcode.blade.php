<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse:collapse;
            table-layout: auto;
        }

        table caption {
            caption-side: top;
        }

        td.a {
                border : 1px solid black;
                padding:1px;
                width: 34mm;
                max-width: 74mm;
                height: 110mm;
                max-height: 110mm;
        }

        td.b {
                border : 1px solid black;
                width: 74mm;
                max-width : 100%;
                vertical-align : baseline;
                font-size : 12px;
                
        }

       
        
        .rotate {
            /* FF3.5+ */
            -moz-transform: rotate(-90.0deg);
            /* Opera 10.5 */
            -o-transform: rotate(-90.0deg);
            /* Saf3.1+, Chrome */
            -webkit-transform: rotate(-90.0deg);
            /* IE6,IE7 */
            filter: progid: DXImageTransform.Microsoft.BasicImage(rotation=0.083);
            /* IE8 */
            -ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)";
            /* Standard */
            transform: rotate(-90.0deg);
        }
    </style>
</head>
<body>
    <table>
    <tr> 
        <td class="b">
           <h3>Insansandang</h2> 
        </td>
        <td class="a" rowspan="4">
            <div class="rotate">
            0000000000BFANTR000000120112120106120011
                <?php
             echo DNS1D::getBarcodeHTML('0000000000BFANTR000000120112120106120011', 'C128',1.1,200);
        ?>
            </div>
        </td>
    </tr>
    <tr>
    <td class="b">GGG PART NUMBER</td>
    </tr>
    <tr>
        <td class="b">Material Description</td>
    </tr>
    <tr>
        <td class="b">Production date: <br> 12121</td>
    </tr>
    <tr>
        <td class="b">Expired Date : </td>
        <td class="b">Batch Number : </td>
    </tr>
    <tr>
        <td class="b">Quantity : </td>
        <td class="b" rowspan="2">Pallet Number : </td>
    </tr>
    <tr>
        <td class="b">Net Weight: </td>
    </tr>
    <tr>
        <td class="b">GG PO No: </td>
        <td class="b"></td>
    </tr>
    <tr>
        <td class="b">Note :</td>
        <td class="b"></td>
    </tr>
    </table>
</body>
</html>
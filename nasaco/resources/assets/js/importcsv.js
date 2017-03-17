window.Controller = window.Controller || {};

(function(Controller){
    Controller.importCsv = function() {
        this.initImportCSV();
    }

    Controller.importCsv.prototype.initImportCSV = function() {
        // document.getElementById('iportCSV').addEventListener('change', handleFile, false);
        document.getElementById('submit').addEventListener('click', handleFile, false);
    }

    
})(window.Controller);

function fixdata(data) {
  var o = "", l = 0, w = 10240;
  for(; l<data.byteLength/w; ++l) o+=String.fromCharCode.apply(null,new Uint8Array(data.slice(l*w,l*w+w)));
  o+=String.fromCharCode.apply(null, new Uint8Array(data.slice(l*w)));
  return o;
}

var rABS = true;

function handleFile() {

    elementImportCSV = document.getElementById('iportCSV');
    var files = elementImportCSV.files;
    if (!files ||  files.length == 0) {
        alert("Mời nhập  file.");
        return;
    }
    var i, f;
    for (i = 0; i != files.length; ++i) {
        f = files[i];
        var reader = new FileReader();
        var name = f.name;
        reader.onload = function (e) {
            var data = e.target.result;

            var workbook;
            if (rABS) {
                /* if binary string, read with type 'binary' */
                workbook = XLSX.read(data, { type: 'binary' });
            } else {
                /* if array buffer, convert to base64 */
                var arr = fixdata(data);
                workbook = XLSX.read(btoa(arr), { type: 'base64' });
            }
            var first_sheet_name = workbook.SheetNames[0];
            getXLSData(workbook.Sheets[first_sheet_name]);
            /* DO SOMETHING WITH workbook HERE */
        };
        reader.readAsBinaryString(f);
    }
}

var cells=[];

function getXLSData(worksheet) {
    cells = [];
    var firstDigit;
    var index;
    
    var numberOfRecord;
    for (var z in worksheet) {
        if (z[0] === '!') continue;
        var cell = {};
        
        firstDigit = z.match(/\d/)
        index = z.indexOf(firstDigit)
        cell.row = z.substring(index);
        cell.column = z.substring(0, index);
        cell.data = worksheet[z].v
        
        cells.push(cell);
    }
    getAllBill();

}


function getUserDataByColumn(col) {
        var result = [];
        cells.forEach(e => {
            if (e.column == col)
                result.push(e);
        })
        return result;
    }

 function  getUserDataByRow(row) {
        var result = [];
        cells.forEach(e => {
            if (e.row == row)
                result.push(e);
        })
        return result;
    }
  function getUserDataByColumnAndRow(row, col) {
        var result ="";
        cells.forEach(e => {
            if (e.row == row && e.column == col)
                {result = e.data;return result;}
        })
        return result;
    } 

    function getAllBill() {
        var bills = [];
        numberOfRecord = getUserDataByColumn(cells[0].column).length;
        numberOfCol = getUserDataByRow(cells[0].row).length ;
        for (let i=1;i<numberOfRecord+1;i++)
        {
            var bill = [];
            for (let j=0;j<numberOfCol;j++)
            {
                bill.push(getUserDataByColumnAndRow(+cells[0].row+i,cells[j].column));
            }
            bills.push(bill);         
        }
        console.log(bills)
            
        convertBillParam(bills);
    }

    function convertBillParam(arrData) {
        var result = {
            bills: []
        };
        
        arrData.forEach(function (data) {
            result.bills.push({
                "ngay_thang_nam": data[0]+"-"+data[1]+"-"+data[2],
                "ngay": data[0],
                "thang": data[1],
                "nam": data[2],
                "mat_hang": data[3],
                "nhom_hang": data[4],
                "dien_giai": data[5],
                "tinh": data[6],
                "ma_buu_chinh": data[7],
                "dvt": data[8],
                "sl_dat_hang": data[9],
                "sl_thuc_xuat": data[10],
                "sl_thanh_toan": data[11],
                "con_lai": data[12],
                "don_gia": data[13],
                "thanh_tien_thanh_toan":data[14]
            })
        })
        console.log(result);
        return result;
    }

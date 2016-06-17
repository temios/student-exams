/**
 * Created by driln on 27.11.2015.
 */
var fieldname = "field1";
var type="type1";
var defaultVar= "default1";
var primary= "Primary1";
var increment= "Increment1";
var arr=[fieldname, type, defaultVar, primary,increment];

var count = 0;
$(function(){
    $("#addRow").on("click", function(){
        count++;
        for (var i=0; i<arr.length; i++){
            arr[i]= arr[i].substring(0,arr[i].length-1);
            arr[i] += count;
        }
        $temp = $("#trTemplate").clone();
        $temp.attr("id","appendedTr").children("td:first-child").children("input").attr("name", arr[0]);
        $temp.attr("id","appendedTr").children("td:nth-child(2)").children("select").attr("name", arr[1]);
        $temp.attr("id","appendedTr").children("td:nth-child(3)").children("select").attr("name", arr[2]);
        $temp.attr("id","appendedTr").children("td:nth-child(4)").children("input").attr("name", arr[3]);
        $temp.attr("id","appendedTr").children("td:last-child").children("input").attr("name", arr[4]);
        $("#dbtable").children("tbody").append($temp);
        $("#rowCount").attr("value", count);

    })
});


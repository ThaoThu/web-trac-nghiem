
$(document).ready(function () {


    //1 lần code ngu chưa biết làm tn
//     function getVal(){
    
//     //1
//     var value1 = $("#1").val();
//     $(document).on('keyup mouseup', '#1', function() {
//     if(this.value !== value1) {
//         value1 = this.value;
//         console.log(value1);

    $(document).on('keyup mouseup', '.de', function() {
        var arr = $('.de').map((i, e) => e.value).get(); //lay value cua nhieu elements trong class
        var number_arr = arr.map(Number); // chuyen arr sang number
        de = number_arr.reduce((total,e)=>total+e,0);
        
    $("#Total_de").html(de);
    });

    $(document).on('keyup mouseup', '.kho', function() {
        var arr = $('.kho').map((i, e) => e.value).get(); //lay value cua nhieu elements trong class
        var number_arr = arr.map(Number); // chuyen arr sang number
        kho = number_arr.reduce((total,e)=>total+e,0);
        
    $("#Total_kho").html(kho);
    });

    $(document).on('keyup mouseup', '.tb', function() {
        var arr = $('.tb').map((i, e) => e.value).get(); //lay value cua nhieu elements trong class
        var number_arr = arr.map(Number); // chuyen arr sang number
        tb = number_arr.reduce((total,e)=>total+e,0);
        
    $("#Total_tb").html(tb);

    });

    $(document).on('keyup mouseup', '.change', function() {
        //set gia tri ban dau
        if(typeof de === 'undefined')de=0;
        if(typeof tb === 'undefined')tb=0;
        if(typeof kho === 'undefined')kho=0;
        total = de + kho +tb ;
        $("#Total").html(total);
        //tinh persent
        var persent_de = (de*100/total).toFixed(2);
        var persent_tb = (tb*100/total).toFixed(2);
        var persent_kho = (100 - persent_de -persent_tb).toFixed(2);
        
        $("#persent_de").html(persent_de)
        $("#persent_tb").html(persent_tb)
        $("#persent_kho").html(persent_kho)
    });
    
});
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div id="graph-div"></div>
    </div>
</div>

<script type="text/javascript" src="<?= base_url('assets/js/jqBarGraph.1.1.min.js') ?>" ></script>
<script type="text/javascript">
    
    $(function() 
    {
        var arrayOfPHPData = <?= json_encode($data) ?>;
        arrayOfDataJS = [];
        $.each(arrayOfPHPData, function(i, element) {
            var month = parseInt(element['month']);
            var amount = parseInt(element['total_amount']);
            amount = amount / 100000;
            arrayOfDataJS[i] = [amount, month];
        });

        console.log(arrayOfDataJS);

        $('#graph-div').jqBarGraph({
            data: arrayOfDataJS, 
            title: false, 
            width: 200, 
            height: 600, 
            barSpace: 20, 
            postfix: ' (lakh)',  
            colors: ['#7D252B', '#242424','#437346','#97D95C']
        });

    });

</script>

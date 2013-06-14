$(function() {

  $('a[rel=tooltip]').tooltip();

  // make code pretty
  window.prettyPrint && prettyPrint();

  /*----------- BEGIN TABLESORTER CODE -------------------------*/
  /* required jquery.tablesorter.min.js*/
  $(".sortableTable").tablesorter();
  /*----------- END TABLESORTER CODE -------------------------*/

  
  
  $('.minimize-box').on('click', function(e){
    e.preventDefault();
    var $icon = $(this).children('i');
    if($icon.hasClass('icon-chevron-down')) {
      $icon.removeClass('icon-chevron-down').addClass('icon-chevron-up');
    } else if($icon.hasClass('icon-chevron-up')) {
      $icon.removeClass('icon-chevron-up').addClass('icon-chevron-down');
    }
  });
  $('.minimize-box').on('click', function(e){
    e.preventDefault();
    var $icon = $(this).children('i');
    if($icon.hasClass('icon-minus')) {
      $icon.removeClass('icon-minus').addClass('icon-plus');
    } else if($icon.hasClass('icon-plus')) {
      $icon.removeClass('icon-plus').addClass('icon-minus');
    }
  });

  $('.close-box').click(function() {
    $(this).closest('.box').hide('slow');
  });

  $('#changeSidebarPos').on('click', function(e) {
    $('body').toggleClass('hide-sidebar');
  });
});


/*--------------------------------------------------------
 BEGIN DASHBOARD SCRIPTS
 ---------------------------------------------------------*/
function dashboard() {
  /*----------- BEGIN CHART CODE -------------------------*/
  var plot = $.plot($("#acessos"),
    chart, 
    {
      series: {
        lines: {
          show: true
        }
        , points: {
          show: true
        }
        // stack: false,
        //  bars: {
        //   show: true,
        //   barWidth: 600 * 100 * 1000,
        //   align: 'center'
        // }
      }
      // ,bars:{ // show the bars with a width of .4
      //   show: true,
      //   barWidth: 60000000
      // }
      
      , grid: {
        hoverable: true,
        clickable: true
      }
      , yaxis: {
        min: 0
      }
      , xaxis:{
        mode: "time",
        timeformat: "%d %b",
        minTickSize: [1, "month"],
        tickSize: [7, "day"]
      }
      , legend: {
        show: true,
        margin: 10,
        container: jQuery("#legend")
      }
    }
  );

  function showTooltip(x, y, contents) {
    $('<div id="tooltip">' + contents + '</div>').css({
      position: 'absolute',
      display: 'none',
      top: y - 60,
      left: x + 15,
      border: '1px solid #fdd',
      padding: '2px',
      'background-color': 'rgba(0,0,0,0.6)',
      color: '#fff'
    }).appendTo("body").fadeIn(200);
  }

  var previousPoint = null;
  $("#acessos").bind("plothover", function(event, pos, item) {
    $("#x").text(pos.x.toFixed(2));
    $("#y").text(pos.y.toFixed(2));

    if (item) {
      if (previousPoint != item.dataIndex) {
        previousPoint = item.dataIndex;

        $("#tooltip").remove();
        var x = new Date(item.datapoint[0]),
            y = item.datapoint[1].toFixed(2);
        showTooltip(item.pageX, item.pageY,
            "<span class='ttip-lbl'>"+item.series.label+"</span>"
          + "<span class='ttip-date'>Data: "
            + x.getDate() + "/"
            + x.getMonth() + "/"
            + x.getFullYear()
          + "</span>"
          + "<span class='ttip-val'>Acessos: "+y+"</span>");
      }
    }
    else {
      $("#tooltip").remove();
      previousPoint = null;
    }
  });
  /*----------- END CHART CODE -------------------------*/


}
/*--------------------------------------------------------
 END DASHBOARD SCRIPTS
 ---------------------------------------------------------*/

/*--------------------------------------------------------
 BEGIN TABLES.HTML SCRIPTS
 ---------------------------------------------------------*/
function metisTable() {

  /*----------- BEGIN datatable CODE -------------------------*/
  $('#dataTable').dataTable({
    "sDom": "<'pull-right'l>t<'row-fluid'<'span6'f><'span6'p>>",
    "sPaginationType": "bootstrap",
    "oLanguage": {
      "sProcessing":   "Processando...",
      "sLengthMenu":   "Mostrar _MENU_ registros",
      "sZeroRecords":  "Não foram encontrados resultados",
      "sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
      "sInfoFiltered": "(filtrado de _MAX_ registros no total)",
      "sInfoPostFix":  "",
      "sSearch":       "Buscar:",
      "sUrl":          "",
      "oPaginate": {
        "sFirst":    "Primeiro",
        "sPrevious": "Anterior",
        "sNext":     "Seguinte",
        "sLast":     "Último"
      }
    }
  });
  /*----------- END datatable CODE -------------------------*/

  /*----------- BEGIN action table CODE -------------------------*/
  $('#actionTable button.remove').on('click', function() {
    $(this).closest('tr').remove();
  });
  $('#actionTable button.edit').on('click', function() {
    $('#editModal').modal({
      show: true
    });
    var val1 = $(this).closest('tr').children('td').eq(1),
        val2 = $(this).closest('tr').children('td').eq(2),
        val3 = $(this).closest('tr').children('td').eq(3);
    $('#editModal #fName').val(val1.html());
    $('#editModal #lName').val(val2.html());
    $('#editModal #uName').val(val3.html());


    $('#editModal #sbmtBtn').on('click', function() {
      val1.html($('#editModal #fName').val());
      val2.html($('#editModal #lName').val());
      val3.html($('#editModal #uName').val());
    });

  });
  /*----------- END action table CODE -------------------------*/

}
/*--------------------------------------------------------
 END TABLES.HTML SCRIPTS
 ---------------------------------------------------------*/

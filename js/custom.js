/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//para el calendario
$(function() {
			$('.dates #usr1').datepicker({
				'format': 'yyyy-mm-dd',
				'autoclose': true,
                                'language': "es",
                                'startDate': '+1d'                                
			});
		});

$(function mousefec(){
$(document).ready(function(){
                $("input#usr1").mouseup(function(){
                    var valor = $(this).val();
                    $("div#mensaje p").html(valor);
                });
            });
        });
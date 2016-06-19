//var n = 0;
//var width = 150;
//var height = 50;
//var margin = 12;

$.fn.leftDuel = function(x, y, width, height, id)
{
	var newBracket = $('<div id=\"duel'+id+'\" class=\"duel duel-left\" style=\"top:'+x+'px;left:'+y+'px\"><div class="info"><div class="order">№</div><div class="type">Раунд</div></div><div class="player"><div class="name">--</div><div class="result">0</div></div><div class="player"><div class="name">--</div><div class="result">0</div></div></div>').height(height).width(width);
	$(this).append(newBracket);
}

$.fn.rightDuel = function(x, y, width, height, id)
{
	var newBracket = $('<div id=\"duel'+id+'\" class=\"duel duel-right\" style=\"top:'+x+'px;right:'+y+'px\"><div class="info"><div class="order">№</div><div class="type">Раунд</div></div><div class="player"><div class="result">0</div><div class="name">--</div></div><div class="player"><div class="result">0</div><div class="name">--</div></div></div>').height(height).width(width);
	$(this).append(newBracket);
}

$.fn.brackets = function(type) {
	var base = $(this).offset();
	base.bracket = new Object();
	
	base.width = $(this).width();
	id = 0;
	
	if(type < 65){
		base.bracket.width = Math.round(base.width / (Math.log2(type / 2) * 2 + 1));
		base.bracket.height = Math.round(base.bracket.width / 2.5); 
		base.bracket.vgap = base.bracket.height / 3;
		base.bracket.hgap = base.bracket.width / 8;
		//base.height = (base.bracket.height + base.bracket.vgap) * (Math.round(type/4));
		base.height = 0;
		
		j = 0;
		limit = type / 2;
		do {
			limit = Math.floor( ( limit + 1 ) / 2 );
			hgap = base.bracket.width / 8;
			y = (base.bracket.width + hgap) * j;
			y = y + hgap / 2;
			for(i = 0; i < limit; i++){
				vgap = base.bracket.vgap + (base.bracket.vgap + base.bracket.height) * (Math.pow(2,j)-1); 
				x = (base.bracket.height + vgap) * i;
				x = x + vgap / 2;
				$(this).leftDuel(x, y, base.bracket.width, base.bracket.height, ++id);
				if(x > base.height) base.height = base.height + base.bracket.height + vgap;
			}
			j++;
		} while(limit > 1);		
		
		j = 0;
		limit = type / 2;
		do {
			limit = Math.floor( ( limit + 1 ) / 2 );
			hgap = base.bracket.width / 8;
			y = (base.bracket.width + hgap) * j;
			y = y + hgap / 2;
			for(i = 0; i < limit; i++){
				vgap = base.bracket.vgap + (base.bracket.vgap + base.bracket.height) * (Math.pow(2,j)-1); 
				x = (base.bracket.height + vgap) * i;
				x = x + vgap / 2;
				$(this).rightDuel(x, y, base.bracket.width, base.bracket.height, ++id);
				if(x > base.height) base.height = base.height + base.bracket.height + vgap;
			}
			j++;
		} while(limit > 1);
		
		$(this).leftDuel(
					base.bracket.height * 1.2 * (type / 5), 
					base.width / 2 - (base.bracket.width * 1.2) / 2 + base.bracket.hgap, 
					base.bracket.width * 1.2, 
					base.bracket.height * 1.2,
					++id
					);
		
		$(this).leftDuel(
				base.bracket.vgap, 
				base.width / 2 - (base.bracket.width * 1.5) / 2 + base.bracket.hgap, 
				base.bracket.width * 1.5, 
				base.bracket.height * 1.5,
				++id
				);
	}
	
	$(this).height(base.height);
	return this;
};

$.fn.leftBrackets = function(type){
	var base = $(this).offset();
	base.bracket = new Object();
	
	base.width = $(this).width();
	
	levels = Math.log2(type);
	base.bracket.width = Math.round(base.width / (levels + 1));
	base.bracket.height = Math.round(base.bracket.width / 2.5); 
	base.bracket.vgap = base.bracket.height / 3;
	base.bracket.hgap = (base.width - (base.bracket.width * levels)) / levels;
	base.height = (base.bracket.height + base.bracket.vgap) * (Math.round(type/2));
	//base.height = 0;
	
	id = 0;
	j = 0;
	limit = type;
	do {
		limit = Math.floor( ( limit + 1 ) / 2 );
		//hgap = base.bracket.width / 8;
		hgap = base.bracket.hgap;
		y = (base.bracket.width + hgap) * j + base.left;
		y = y + hgap / 2;
		for(i = 0; i < limit; i++){
			vgap = base.bracket.vgap + (base.bracket.vgap + base.bracket.height) * (Math.pow(2,j)-1); 
			x = (base.bracket.height + vgap) * i + base.top;
			x = x + vgap / 2;
			if(limit == 1){
				$(this).leftDuel(x, y, base.bracket.width, base.bracket.height, id+2);
				x = x + base.bracket.vgap * 2 + base.bracket.height;
				$(this).leftDuel(x, y, base.bracket.width, base.bracket.height, id+1);
			} else {
				$(this).leftDuel(x, y, base.bracket.width, base.bracket.height, ++id);
			}
			//if(x > base.height) base.height = base.height + base.bracket.height;
		}
		j++;
	} while(limit > 1);
	$(this).height(base.height);
	
	return this;
};

$.fn.fillBrackets = function(data){
	data.forEach(function(item){
		$('#duel'+item.order).click(function(){
			$( location ).attr('href', item.link);
		});
		fontSize = $('#duel'+item.order).width() * 0.05 + 'px';
		$('#duel'+item.order+' > .info > .order').html('№'+item.order).css('font-size', fontSize);
		$('#duel'+item.order+' > .info > .type').html(item.type.text).css('font-size', fontSize);
		fontSize = $('#duel'+item.order).width() * 0.07 + 'px';
		$('#duel'+item.order+' > .player > .name').first().html(item.player1.name_surname).css('font-size', fontSize);
		$('#duel'+item.order+' > .player > .name').last().html(item.player2.name_surname).css('font-size', fontSize);
		fontSize = $('#duel'+item.order).width() * 0.12 + 'px';
		$('#duel'+item.order+' > .player > .result').first().html(item.result1).css('font-size', fontSize);
		$('#duel'+item.order+' > .player > .result').last().html(item.result2).css('font-size', fontSize);
	});
};

$.getJSON("http://192.168.100.6:8080/index.php/ajax/brackets/1", function(response, e){
	console.log(response);
	$('#main').leftBrackets(response.length).fillBrackets(Array.from(response));
	$(window).resize(function(){
		$('#main').empty().leftBrackets(response.length).fillBrackets(Array.from(response));
	});
	console.error(e);
});

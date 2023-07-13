function order(config){

	

	var o=this, $=jQuery;

	

	o.wordsPerPage=config.wordsPerPage;

	o.top10cost=config.top10cost;

	o.vipcost=config.vipcost;

	o.discount=0;

	

	o.numOfPages = function(){

		var spacing = arguments[0] || 1, maxPages=100, selectOptions=new Array('<option value="">Select</option>');

		o.wordsPerPage = config.wordsPerPage*spacing;

		for(i=1; i<=maxPages; i++) selectOptions.push('<option value="', o.wordsPerPage*i, '">', o.wordsPerPage*i, ' words</option>');

		return selectOptions.join('');

	}

	

	o.total = function(pages, spacing, level, urgency, essayType){
		return ( (parseFloat(level) + parseFloat(urgency) + parseFloat(o.top10cost)) * (parseInt(pages) * parseFloat(essayType) * parseInt(spacing)) ) + o.vipcost
		//return (parseInt(pages)*spacing*(((parseInt(level)+25+parseFloat(o.top10cost))/(parseInt(urgency)+3))+9))+parseFloat(o.vipcost)+parseFloat(essayType);

	}

	

	o.setStatus = function(status, id, cb){

		$.get(config.url+'/order', {status:status, task:'order.set_status', id:id}, function(resp){

			cb();

		}, 'json').error(function(e){

			console.log(e.statusText);

		});

	}

	

}


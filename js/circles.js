// CIRCLES
var circles = (function() {
	var _m = {};
	var refresh;

	var groups = {
		regions: {
			west: 0,
			middle: 0,
			east: 0,
			raised: ''
		},
		genders: {
			men: 0,
			women: 0,
			raised: ''
		},
		sports: {
			football: 0,
			hockey: 0,
			raised: ''
		},
		food: {
			herbivores: 0,
			carnivores: 0,
			raised: ''
		},
		pets: {
			dogs: 0,
			cats: 0,
			raised: ''
		},
		trees: {
			live: 0,
			fake: 0,
			raised: ''
		}
	};

	_m.initVoteRefresh = function() {
		refresh = setInterval(function() {
			_m.getVotes(true);
		}, 10000);
	};

	/**
	 * Method runs a request that will update a main JSON object.
	 */
	_m.getVotes = function(update) {
		update = (typeof update == 'boolean') ? update : false;
		$.post('/votes', function(res) {
			var newGroups = JSON.parse(res);
			if (update)
				setPointsToGraphs(newGroups);
			groups = newGroups;
		});
	};

	/**
	 * Gets total sum of points for a given group.
	 * Method calculates a sum of all the subgroup values for a given group.
	 * @param string group - name of a group whose sum is being obtained
	 * @return int - total sum of points for a defined group
	 */
	var getSum = function(group, source) {
		source = (typeof source !== 'undefined') ? source : groups;
		var sum = 0;
		for (subgroup in source[group]) {
			if (!source[group].hasOwnProperty(subgroup) || subgroup == 'raised')
				continue;

			sum += source[group][subgroup];
		}

		return parseInt(sum);
	};

	/**
	 * Gets a portion of a given subgroup in a total defined group points as float value.
	 * Calculates a total sum of a given group and then finds out what portion is 
	 * given subgroup representing.
	 * @param string group - name of a group
	 * @param string subgroup name of a subgroup, whose numeric portion we want to obtain
	 * @return float - numeric representation of a subgroups' portion
	 */
	var getPortionFrom = function(source, group, subgroup) {
		var sum = getSum(group, source);
		var portion = source[group][subgroup];

		return (sum) ? parseFloat(portion / sum) : 0;
	}

	/**
	 * Create a percentage value from a decimal number
	 * @param float value - a decimal number to be converted into percentage value
	 * @reutrn float a percentage value rounded to 2 decimals
	 */
	var percentageValue = function(value) {
		return Math.round(value * 10000) / 100;
	};


	/**
	 * Runs for each main subgroup and updates its current value/size.
	 * Method runs through whole `main` variable and for each subgroup tries to find an additional element.
	 * If element is found, method calculates both old and new percentage portion of a 100% for a current group,
	 * scales the current element and runs a `raisePercentage()` method that dynamically updates a text value inside.
	 */
	var setPointsToGraphs = function(newGroups) {
		for (var group in groups) {
			if (!groups.hasOwnProperty(group))
				continue;
		
			var oldSum = getSum(group, groups);
			var newSum = getSum(group, newGroups);

			for (var subgroup in groups[group]) {
				if (subgroup == 'raised')
					continue;
				var elemIdPercent = '#' + subgroup + ' .circle__percent';
				
				if (!$(elemIdPercent).length)
					continue;

				if (!groups[group].hasOwnProperty(subgroup))
					continue;

				var oldPortion = getPortionFrom(groups, group, subgroup);
				var newPortion = getPortionFrom(newGroups, group, subgroup);
				
				if (oldPortion == newPortion && oldSum == newSum && newSum)
					continue;

				if (!newPortion && !newSum) {
					oldPortion = newPortion = getDefaultPortion(group);
				}

				_m.raisePercentage($(elemIdPercent), oldPortion, newPortion);
				
				newPortion = newPortion / 3;
				newPortion += 0.6;
				
				if (groups[group][subgroup] < newGroups[group][subgroup])
					splash(elemIdPercent);

				$(elemIdPercent).css('transform', 'scale(' + newPortion + ')');

			}
		}
	};

	var getDefaultPortion = function(group) {
		var groupMembers = -1; // because there is a "raised" attribute in every group

		for (var sg in groups[group]) {
			if (groups[group].hasOwnProperty(sg))
				groupMembers++;
		}

		return (100 / groupMembers) / 100;
	}

	var splash = function(elem) {
		var splashColor = $(elem).data('splash');
		var splashClass = 'circle--raise-' + splashColor;
		$(elem).removeClass(splashClass);
		setTimeout(function() {
			$(elem).addClass(splashClass);
		}, 100);
	}

	/**
	 * Adds a point to the current subgroup
	 * Methods adds a +1 point to a current subgroup of a group and returns new subgroup count.
	 * @param string group - name of a group
	 * @param string subgroup - name of a subgroup whose count will be updated
	 * @return int - new value of a given subgroup
	 */
	_m.addPoint = function(group, subgroup) {
		groups[group][subgroup]++;
		groups[group].raised = subgroup;
		setPointsToGraphs();
		return groups[group][subgroup];
	};

	/**
	 * Starts an animation that dynamically updates a numeric value inside a given circle.
	 * Value runs form old value to new value with a step calculated for a 1/60th of a second.
	 * Animation duration is one second.
	 * @param jQuery Objeect $elem - jQuery object of a currently updated element
	 * @param oldVal - portion count before addiction
	 * @param newVal - portion count after adding a point
	 */
	_m.raisePercentage = function($elem, oldVal, newVal) {
		oldVal = percentageValue(oldVal);
		newVal = percentageValue(newVal);
		
		// if (oldVal == newVal && newVal)
		// 	return;

		var frame = 1000/60;
		var frameVal = (newVal - oldVal) / frame;
		var tempVal = oldVal;

		var raiseInterval = setInterval(function () {
			tempVal += frameVal;
			tempVal = Math.round(tempVal * 100) / 100;
			
			setPercentage($elem, tempVal);
			
			if (tempVal >= newVal) {
				setPercentage($elem, newVal);
				clearInterval(raiseInterval);
			}
		}, frame);
	}

	var setPercentage = function($elem, value) {
		var intVal = Math.floor(value);
		var decVal = Math.round((value - intVal) * 100);
		
		$elem.find('.value__int').text(intVal);
		$elem.find('.value__dec').text(decVal);
	}
	
	_m.getGroups = function() {
		return groups;
	};
	return _m;
})();
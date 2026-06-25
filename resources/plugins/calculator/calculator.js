// Determines button clicked via id
function calEnterVal(id) {
  document.calc.result.value+=id;
}

function normalizePercentageExpression(expression) {
  var parsedExpression = expression;

  // Handle cases like: 1000-10% => 1000-(1000*10/100)
  var additivePercentageRegex = /(\d+(?:\.\d+)?)([+\-])(\d+(?:\.\d+)?)%/;
  while (additivePercentageRegex.test(parsedExpression)) {
    parsedExpression = parsedExpression.replace(
      additivePercentageRegex,
      '($1$2($1*$3/100))'
    );
  }

  // Convert remaining percentages like: 10% => (10/100)
  parsedExpression = parsedExpression.replace(/(\d+(?:\.\d+)?)%/g, '($1/100)');
  
  return parsedExpression;
}

// Clears calculator input screen
function clearScreen() {
  document.calc.result.value="";
}

// Calculates input values
function calculate() {
  try {
    var inputExpression = normalizePercentageExpression(document.calc.result.value);
    var input = eval(inputExpression);
    document.calc.result.value=input;
  } catch(err){
      document.calc.result.value="Error";
    }
}

$(document).ready( function(){
	$('#btnCalculator').popover();
});
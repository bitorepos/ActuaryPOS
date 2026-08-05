<div id="calculator">
  <div class="row justify-content-center" id="calc">
    <div class="calcBG col-md-12 text-center">
      <div class="row mb-2" id="result">
        <form name="calc" class="w-100">
          <input type="text" class="form-control text-end bg-light" name="result" readonly>
        </form>
      </div>

      <div class="row g-1">
        <div class="col-3"><button id="allClear" type="button" class="btn btn-danger w-100" onclick="clearScreen()">AC</button></div>
        <div class="col-3"><button id="clear" type="button" class="btn btn-warning w-100" onclick="clearScreen()">CE</button></div>
        <div class="col-3"><button id="%" type="button" class="btn btn-secondary w-100" onclick="calEnterVal(this.id)">%</button></div>
        <div class="col-3"><button id="/" type="button" class="btn btn-secondary w-100" onclick="calEnterVal(this.id)">÷</button></div>
      </div>

      <div class="row g-1 mt-1">
        <div class="col-3"><button id="7" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">7</button></div>
        <div class="col-3"><button id="8" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">8</button></div>
        <div class="col-3"><button id="9" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">9</button></div>
        <div class="col-3"><button id="*" type="button" class="btn btn-secondary w-100" onclick="calEnterVal(this.id)">×</button></div>
      </div>

      <div class="row g-1 mt-1">
        <div class="col-3"><button id="4" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">4</button></div>
        <div class="col-3"><button id="5" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">5</button></div>
        <div class="col-3"><button id="6" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">6</button></div>
        <div class="col-3"><button id="-" type="button" class="btn btn-secondary w-100" onclick="calEnterVal(this.id)">−</button></div>
      </div>

      <div class="row g-1 mt-1">
        <div class="col-3"><button id="1" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">1</button></div>
        <div class="col-3"><button id="2" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">2</button></div>
        <div class="col-3"><button id="3" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">3</button></div>
        <div class="col-3"><button id="+" type="button" class="btn btn-secondary w-100" onclick="calEnterVal(this.id)">+</button></div>
      </div>

      <div class="row g-1 mt-1">
        <div class="col-3"><button id="0" type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">0</button></div>
        <div class="col-3"><button id="." type="button" class="btn btn-light w-100" onclick="calEnterVal(this.id)">.</button></div>
        <div class="col-3"><button id="equals" type="button" class="btn btn-success w-100" onclick="calculate()">=</button></div>
        <div class="col-3"><button id="blank" type="button" class="btn btn-light w-100" disabled>&nbsp;</button></div>
      </div>
    </div>
  </div>
</div>

<h1>Logistics Module</h1>

<div class="row">
    <div class="col-3">
        <div class="card ">
            <div class="card-body hstack">
                <h2 class="card-title"><a href="/logistics/part-number" class="card-link text-decoration-none">Part Numbers</a></h2>
                <span class="badge bg-secondary ms-auto"><?= $partNumbers ?></span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card ">
            <div class="card-body hstack">
                <h2 class="card-title"><a href="/logistics/shipment" class="card-link text-decoration-none">Shipments</a></h2>
                <span class="badge bg-secondary ms-auto"><?= $shipments ?></span>
            </div>
        </div>
    </div>
    <div class="col-3">
        <div class="card ">
            <div class="card-body hstack">
                <h2 class="card-title"><a href="/logistics/warehouse" class="card-link text-decoration-none">Warehouses</a></h2>
                <span class="badge bg-secondary ms-auto"><?= $warehouses ?></span>
            </div>
        </div>
    </div>
</div>
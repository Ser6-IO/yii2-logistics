<h1>Logistics</h1>

<div class="row">
    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">

                <div class="hstack">

                    <a href="/logistics/part-number" class="card-link text-decoration-none lead">Part Numbers</a>                    

                    <p class="display-6 ms-auto"><span class="badge bg-info"><?= $partNumbers ?></span></p>    
                    
                </div>
                
                <div class="hstack">
                    <a class="btn btn-outline-success" href="/logistics/part-number/create" title="New" data-bs-toggle="tooltip">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                    &nbsp;
                    <div class="input-group">    
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary"  title="Search" data-bs-toggle="tooltip" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">

                <div class="hstack">

                    <a href="/logistics/shipment/index" class="card-link text-decoration-none lead">Shipments</a>                    

                    <p class="display-6 ms-auto"><span class="badge bg-info"><?= $shipments ?></span></p>    
                    
                </div>
                
                <div class="hstack">
                    <a class="btn btn-outline-success" href="/logistics/shipment/create" title="New" data-bs-toggle="tooltip">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                    &nbsp;
                    <div class="input-group">    
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary"  title="Search" data-bs-toggle="tooltip" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card mb-3">
            <div class="card-body">

                <div class="hstack">

                    <a href="/logistics/warehouse/index" class="card-link text-decoration-none lead">Warehouses</a>                    

                    <p class="display-6 ms-auto"><span class="badge bg-info"><?= $warehouses ?></span></p>    
                    
                </div>
                
                <div class="hstack">
                    <a class="btn btn-outline-success" href="/logistics/warehouse/create" title="New" data-bs-toggle="tooltip">
                        <i class="bi bi-plus-circle"></i>
                    </a>
                    &nbsp;
                    <div class="input-group">    
                        <input type="text" class="form-control" placeholder="Search...">
                        <button class="btn btn-outline-secondary"  title="Search" data-bs-toggle="tooltip" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                
            </div>
        </div>
    </div>

</div>
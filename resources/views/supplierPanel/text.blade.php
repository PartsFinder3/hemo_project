<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Ad Card</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
</head>
<body class="bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Ad Card -->
                <div class="card shadow-sm">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <!-- Ad Content -->
                            <div class="col-10">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">Premium iPhone 15 Pro Max - Excellent Condition</h5>
                                    <span class="badge bg-success ms-2">Approved</span>
                                </div>
                                <h6 class="text-primary fw-bold mb-2">$999.00</h6>
                                <p class="card-text text-muted mb-0">
                                    Brand new iPhone 15 Pro Max in pristine condition. Comes with original box, charger, and all accessories.
                                    Perfect for anyone looking for a high-end smartphone at a great price.
                                </p>
                            </div>

                            <!-- Dropdown Menu -->
                            <div class="col-2 text-end">
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item" href="#" onclick="editAd()">
                                                <i class="bi bi-pencil-square me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" onclick="deleteAd()">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Additional Example Cards -->
                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">Vintage Leather Sofa Set</h5>
                                    <span class="badge bg-warning text-dark ms-2">Pending</span>
                                </div>
                                <h6 class="text-primary fw-bold mb-2">$450.00</h6>
                                <p class="card-text text-muted mb-0">
                                    Beautiful vintage leather sofa set in good condition. Perfect for living room or office space.
                                    Comfortable seating for up to 5 people.
                                </p>
                            </div>
                            <div class="col-2 text-end">
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="editAd()"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteAd()"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card shadow-sm mt-3">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col-10">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="card-title mb-0">Mountain Bike - Trek 2023</h5>
                                    <span class="badge bg-danger ms-2">Rejected</span>
                                </div>
                                <h6 class="text-primary fw-bold mb-2">$650.00</h6>
                                <p class="card-text text-muted mb-0">
                                    High-quality mountain bike, barely used. Perfect for weekend adventures and daily commuting.
                                    Includes helmet and accessories.
                                </p>
                            </div>
                            <div class="col-2 text-end">
                                <div class="dropdown">
                                    <button class="btn btn-link text-muted p-1" type="button" data-bs-toggle="dropdown">
                                        <i class="bi bi-three-dots-vertical fs-5"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        <li><a class="dropdown-item" href="#" onclick="editAd()"><i class="bi bi-pencil-square me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item text-danger" href="#" onclick="deleteAd()"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

    <script>
        function editAd() {
            alert('Edit function triggered! You can implement your edit logic here.');
        }

        function deleteAd() {
            if (confirm('Are you sure you want to delete this ad?')) {
                alert('Delete function triggered! You can implement your delete logic here.');
            }
        }
    </script>
</body>
</html>

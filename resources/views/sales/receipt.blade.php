<!-- index.html -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script src="https://raw.githack.com/eKoopmans/html2pdf/master/dist/html2pdf.bundle.js"></script>
</head>
<body>
    <main class="container mt-5">
        <section>
            <div class="card">
                <div class="card-body">
                    <h1 class="text-center">Customer Invoice</h1>
                    <div class="invoice-info">
                        <div class="d-flex flex-column">
                        <div>Invoice ID: {{ $invoiceId ?? '1' }}</div>
                            <div>Customer name: {{ $customerName ?? 'Default Name' }}</div>
                            <div>Customer phone: {{ $customerPhone ?? '000-000-0000' }}</div>
                            <div>Customer address: {{ $customerAddress ?? 'Default Address' }}</div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Product</th>
                                    <th scope="col">Barcode</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                 <tr>
                                    <td>
                                        Pham Quoc Trieu
                                        <p class="text-muted">
                                            Đầu moi thiểu năng.
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>
                                
                                <tr>
                                    <td>
                                        Do Hoang Phong
                                        <p class="text-muted">
                                           Chúa tể racist.
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>

                                <tr>
                                    <td>
                                        Nguyen Le Tuan Phuong
                                        <p class="text-muted">
                                           Nerd CNTT
                                        </p>
                                    </td>
                                    <td>none</td>
                                    <td>none</td>
                                    <td>none</td>
                                </tr>

                                <tr>
                                    <td>&nbsp;</td>
                                    <td colspan="2">
                                        <h5 class="text-success text-center "><strong>Grand Total</strong></h5>
                                    </td>
                                    <td>
                                        <h5 class="text-success"><strong>$1000000</strong></h5>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="invoice-footer text-center">
                        Thank you for your Business.
                    </div>
                </div>
            </div>
        </section>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
            <a href="#" role="button" class="btn btn-outline-success btn-lg" id="print-btn" type="button">Print</a>
             <a href="#" role="button" class="btn btn-outline-danger btn-lg" id="delete-btn" type="button">Delete</a>
         </div>

        <div class="modal fade" id="confirm-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to proceed?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" id="confirm-btn">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
    const printBtn = document.getElementById('print-btn');
    const deleteBtn = document.getElementById('delete-btn');
    const confirmModal = new bootstrap.Modal(document.getElementById('confirm-modal'));
    const confirmBtn = document.getElementById('confirm-btn');

    function generatePDF() {
        const element = document.querySelector('section');
        html2pdf()
            .from(element)
            .save();
    }

    printBtn.addEventListener('click', () => {
        confirmModal.show();
    });

    deleteBtn.addEventListener('click', () => {
        confirmModal.show();
    });

    confirmBtn.addEventListener('click', () => {
        generatePDF();
    });
</script>
</body>
</html>
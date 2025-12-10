


// Pagination
function setupPagination(gridId, paginationId, perPage = 6) {
    const products = document.querySelectorAll(`#${gridId} .card`);
    const totalPages = Math.ceil(products.length / perPage);
    const pagination = document.getElementById(paginationId);

    if (!pagination) return;

    function showPage(page) {
        products.forEach((product, i) => {
            product.style.display =
                i >= (page - 1) * perPage && i < page * perPage
                    ? "block"
                    : "none";
        });

        pagination.querySelectorAll("button").forEach((btn, i) => {
            btn.classList.toggle("active", i + 1 === page);
        });
    }

    pagination.innerHTML = "";

    for (let i = 1; i <= totalPages; i++) {
        const btn = document.createElement("button");
        btn.innerText = i;
        btn.addEventListener("click", () => showPage(i));
        pagination.appendChild(btn);
    }

    if (totalPages > 0) {
        showPage(1);
    }
}

document.addEventListener("DOMContentLoaded", function () {
    setupPagination("productGrid1", "pagination1");
});


// Bootstrap toast notifications
document.addEventListener("DOMContentLoaded", function () {
    const toastElList = [].slice.call(document.querySelectorAll(".toast"));
    toastElList.map(function (toastEl) {
        const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
        toast.show();
    });
});


document.head.appendChild(style);
function sendProductInquiryWhatsapp(whatsapp, title) {
    let formData = new FormData(document.getElementById('productInquiryForm'));

    fetch("{{ route('product.inquiry.send') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            let msg = encodeURIComponent("Hello, I am interested in: " + title);
            window.open("https://wa.me/" + whatsapp + "?text=" + msg, "_blank");
        } else {
            alert("کچھ غلط ہو گیا!");
        }
    })
    .catch(err => console.log(err));
}

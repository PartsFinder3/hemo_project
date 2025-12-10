



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

document.addEventListener("DOMContentLoaded", function () {
    // Initialize Select2 for all dropdowns
    $('.mySelect').each(function() {
        $(this).select2({
            placeholder: $(this).find('option:first').text(),
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: true,
            minimumResultsForSearch: 0, // سرچ ہمیشہ دکھائیں
            dropdownParent: $(this).parent()
        });
    });

    // باقی آپ کا موجودہ JavaScript کوڈ یہاں رہے گا
    function createPartTag(partId) {
        const partOption = document.querySelector(
            `#parts-dropdown option[value="${partId}"]`
        );
        const partName = partOption ? partOption.textContent : partId;
        const tag = document.createElement("div");
        tag.className = "part-tag";
        tag.innerHTML = `${partName} <button type="button" class="remove-btn">&times;</button>`;
        tag.querySelector(".remove-btn").addEventListener("click", () =>
            removePart(partId, tag)
        );
        partsTagsContainer.appendChild(tag);
    }

    function removePart(partId, tagNode) {
        selectedParts = selectedParts.filter((p) => p !== partId);
        if (tagNode) tagNode.remove();
        updateFindButton();
    }

    // FETCH MODELS when make changes - Select2 compatible
    $('#make').on('change', async function () {
        const makeId = this.value;

        // Reset model dropdown with loading state
        $('#model').empty().append('<option value="">Loading...</option>');
        $('#model').prop('disabled', true);
        $('#model').trigger('change.select2');

        // Hide later groups
        hideFormGroup(partsGroup);
        hideFormGroup(conditionGroup);

        if (!makeId) {
            $('#model').empty().append('<option value="">Select Your Model</option>');
            $('#model').trigger('change.select2');
            updateFindButton();
            return;
        }

        try {
            const endpointBase = window.getModelsUrl;
            const res = await fetch(endpointBase + encodeURIComponent(makeId));

            if (!res.ok)
                throw new Error("HTTP " + res.status + " " + res.statusText);

            const data = await res.json();
            
            $('#model').empty();
            $('#model').append('<option value="">Select Your Model</option>');

            if (Array.isArray(data) && data.length > 0) {
                data.forEach((m) => {
                    $('#model').append(`<option value="${m.id}">${m.name}</option>`);
                });
                showFormGroup(modelGroup);
                $('#model').prop('disabled', false);
            } else {
                $('#model').append('<option value="">No models available</option>');
                showFormGroup(modelGroup);
                $('#model').prop('disabled', true);
            }

            // Refresh Select2
            $('#model').trigger('change.select2');
        } catch (err) {
            console.error("Error fetching models:", err);
            $('#model').empty().append('<option value="">Error loading models</option>');
            $('#model').trigger('change.select2');
            showFormGroup(modelGroup);
            $('#model').prop('disabled', true);
        }
        updateFindButton();
    });

    // Progressive reveal with Select2 compatibility
    $('#model').on('change', function () {
        if (this.value) {
            showFormGroup(yearGroup);
            $('#year').prop('disabled', false);
        } else {
            hideFormGroup(yearGroup);
            hideFormGroup(partsGroup);
            hideFormGroup(conditionGroup);
            $('#year').prop('disabled', true);
            $('#parts-dropdown').prop('disabled', true);
        }
        updateFindButton();
    });

    $('#year').on('change', function () {
        if (this.value) {
            showFormGroup(partsGroup);
            $('#parts-dropdown').prop('disabled', false);
        } else {
            hideFormGroup(partsGroup);
            hideFormGroup(conditionGroup);
            $('#parts-dropdown').prop('disabled', true);
        }
        updateFindButton();
    });

    $('#parts-dropdown').on('change', function () {
        if (this.value && !selectedParts.includes(this.value)) {
            selectedParts.push(this.value);
            createPartTag(this.value);
            $(this).val('').trigger('change.select2');
            showFormGroup(conditionGroup);
            updateFindButton();
        }
    });

    // باقی کوڈ...
});
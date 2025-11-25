document.addEventListener("DOMContentLoaded", function () {
    // DOM refs
    const makeSelect = document.getElementById("make");
    const modelSelect = document.getElementById("model");
    const yearSelect = document.getElementById("year");
    const partsDropdown = document.getElementById("parts-dropdown");
    const partsTagsContainer = document.getElementById("parts-tags");
    const findBtn = document.getElementById("find-btn");

    const modelGroup = document.getElementById("model-group");
    const yearGroup = document.getElementById("year-group");
    const partsGroup = document.getElementById("parts-group");
    const conditionGroup = document.getElementById("condition-group");

    let selectedParts = [];

    // helpers (keep your original animations)
    function showFormGroup(group) {
        group.classList.remove("hidden");
        setTimeout(() => group.classList.add("show"), 50);
    }
    function hideFormGroup(group) {
        group.classList.remove("show");
        setTimeout(() => group.classList.add("hidden"), 300);
    }

    function updateFindButton() {
        const hasBasicInfo =
            makeSelect.value && modelSelect.value && yearSelect.value;
        const hasParts = selectedParts.length > 0;
        findBtn.disabled = !(hasBasicInfo && hasParts);
    }

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

    // FETCH MODELS when make changes
    makeSelect.addEventListener("change", async function () {
        const makeId = this.value;

        // reset model dropdown
        modelSelect.innerHTML = '<option value="">Loading...</option>';
        modelSelect.disabled = true;

        // hide later groups
        // hideFormGroup(yearGroup);
        hideFormGroup(partsGroup);
        hideFormGroup(conditionGroup);

        if (!makeId) {
            modelSelect.innerHTML =
                '<option value="">Select Your Model</option>';
            // hideFormGroup(modelGroup);
            updateFindButton();
            return;
        }

        try {
            // Use Laravel url helper when rendering blade -> safer if app not at root
            const endpointBase = window.getModelsUrl;
            const res = await fetch(endpointBase + encodeURIComponent(makeId));

            if (!res.ok)
                throw new Error("HTTP " + res.status + " " + res.statusText);

            const data = await res.json();
            modelSelect.innerHTML =
                '<option value="">Select Your Model</option>';

            if (Array.isArray(data) && data.length > 0) {
                data.forEach((m) => {
                    const opt = document.createElement("option");
                    opt.value = m.id;
                    opt.textContent = m.name;
                    modelSelect.appendChild(opt);
                });
                showFormGroup(modelGroup);
                modelSelect.disabled = false;
            } else {
                modelSelect.innerHTML =
                    '<option value="">No models available</option>';
                showFormGroup(modelGroup);
                modelSelect.disabled = true;
            }
        } catch (err) {
            console.error("Error fetching models:", err);
            modelSelect.innerHTML =
                '<option value="">Error loading models</option>';
            showFormGroup(modelGroup);
            modelSelect.disabled = true;
        }
        updateFindButton();
    });

    // Keep your progressive reveal listeners (they were fine)
    modelSelect.addEventListener("change", function () {
        if (this.value) {
            showFormGroup(yearGroup);
            yearSelect.disabled = false;
        } else {
            hideFormGroup(yearGroup);
            hideFormGroup(partsGroup);
            hideFormGroup(conditionGroup);
            yearSelect.disabled = true;
            partsDropdown.disabled = true;
        }
        updateFindButton();
    });

    yearSelect.addEventListener("change", function () {
        if (this.value) {
            showFormGroup(partsGroup);
            partsDropdown.disabled = false;
        } else {
            hideFormGroup(partsGroup);
            hideFormGroup(conditionGroup);
            partsDropdown.disabled = true;
        }
        updateFindButton();
    });

    partsDropdown.addEventListener("change", function () {
        if (this.value && !selectedParts.includes(this.value)) {
            selectedParts.push(this.value);
            createPartTag(this.value);
            this.value = "";
            showFormGroup(conditionGroup);
            updateFindButton();
        }
    });

    findBtn.addEventListener("click", function () {
        if (findBtn.disabled) return;
        const conditionElement = document.querySelector(
            'input[name="condition"]:checked'
        );
        if (!conditionElement) {
            alert("Please select a condition option");
            return;
        }
        const searchData = {
            make: makeSelect.value,
            model: modelSelect.value,
            year: yearSelect.value,
            parts: selectedParts,
            condition: conditionElement.value,
        };
        console.log("Search Data:", searchData);
        // show friendly alert (you can replace with actual submit)
        const makeName = makeSelect.options[makeSelect.selectedIndex].text;
        const modelName = modelSelect.options[modelSelect.selectedIndex].text;
        const yearName = yearSelect.options[yearSelect.selectedIndex].text;
        const partNames = selectedParts.map((id) => {
            const o = document.querySelector(
                `#parts-dropdown option[value="${id}"]`
            );
            return o ? o.textContent : id;
        });
        // alert(`Searching for ${partNames.join(', ')} for ${yearName} ${makeName} ${modelName} in ${searchData.condition} condition!`);
    });
});
console.log("Make:", makeSelect.value);
console.log("Model:", modelSelect.value);
console.log("Year:", yearSelect.value);
console.log("Parts:", selectedParts);

updateFindButton();

// document.addEventListener("DOMContentLoaded", function () {
//     // DOM refs
//     const makeSelect = document.getElementById("make");
//     const modelSelect = document.getElementById("model");
//     const yearSelect = document.getElementById("year");
//     const partsDropdown = document.getElementById("parts-dropdown");
//     const partsTagsContainer = document.getElementById("parts-tags");
//     const findBtn = document.getElementById("find-btn");

//     const modelGroup = document.getElementById("model-group");
//     const yearGroup = document.getElementById("year-group");
//     const partsGroup = document.getElementById("parts-group");
//     const conditionGroup = document.getElementById("condition-group");

//     let selectedParts = [];

//     // Initialize Choices.js for searchable dropdowns
//     const makeChoices = new Choices('#make', {
//         searchEnabled: true,
//         searchPlaceholderValue: 'Search make...',
//         itemSelectText: '',
//         shouldSort: false,
//         removeItemButton: false,
//         position: 'bottom',
//         resetScrollPosition: false
//     });

//     const modelChoices = new Choices('#model', {
//         searchEnabled: true,
//         searchPlaceholderValue: 'Search model...',
//         itemSelectText: '',
//         shouldSort: false,
//         removeItemButton: false,
//         position: 'bottom',
//         resetScrollPosition: false
//     });

//     const yearChoices = new Choices('#year', {
//         searchEnabled: true,
//         searchPlaceholderValue: 'Search year...',
//         itemSelectText: '',
//         shouldSort: false,
//         removeItemButton: false,
//         position: 'bottom',
//         resetScrollPosition: false
//     });

//     const partsChoices = new Choices('#parts-dropdown', {
//         searchEnabled: true,
//         searchPlaceholderValue: 'Search parts...',
//         itemSelectText: '',
//         shouldSort: false,
//         removeItemButton: false,
//         position: 'bottom',
//         resetScrollPosition: false
//     });

//     // Helper functions
//     function showFormGroup(group) {
//         group.classList.remove("hidden");
//         setTimeout(() => group.classList.add("show"), 50);
//     }

//     function hideFormGroup(group) {
//         group.classList.remove("show");
//         setTimeout(() => group.classList.add("hidden"), 300);
//     }

//     function updateFindButton() {
//         const hasBasicInfo =
//             makeSelect.value && modelSelect.value && yearSelect.value;
//         const hasParts = selectedParts.length > 0;
//         findBtn.disabled = !(hasBasicInfo && hasParts);
//     }

//     function createPartTag(partId) {
//         const partOption = document.querySelector(
//             `#parts-dropdown option[value="${partId}"]`
//         );
//         const partName = partOption ? partOption.textContent : partId;
//         const tag = document.createElement("div");
//         tag.className = "part-tag";
//         tag.innerHTML = `
//             ${partName}
//             <input type="hidden" name="parts[]" value="${partId}">
//             <button type="button" class="remove-btn">&times;</button>
//         `;
//         tag.querySelector(".remove-btn").addEventListener("click", () =>
//             removePart(partId, tag)
//         );
//         partsTagsContainer.appendChild(tag);
//     }

//     function removePart(partId, tagNode) {
//         selectedParts = selectedParts.filter((p) => p !== partId);
//         if (tagNode) tagNode.remove();
//         updateFindButton();
//     }

//     // FETCH MODELS when make changes - Listen to Choices.js change event
//     makeSelect.addEventListener("change", async function () {
//         const makeId = this.value;

//         console.log("Make selected:", makeId); // Debug log

//         // Reset model dropdown with loading state
//         modelChoices.clearStore();
//         modelChoices.setChoices([
//             { value: '', label: 'Loading...', disabled: true, selected: true }
//         ], 'value', 'label', true);
//         modelChoices.disable();

//         // Hide later groups
//         hideFormGroup(partsGroup);
//         hideFormGroup(conditionGroup);

//         if (!makeId) {
//             modelChoices.clearStore();
//             modelChoices.setChoices([
//                 { value: '', label: 'Select Your Model', selected: true }
//             ], 'value', 'label', true);
//             updateFindButton();
//             return;
//         }

//         try {
//             const endpointBase = window.getModelsUrl || '/api/models/';
//             const url = endpointBase + encodeURIComponent(makeId);

//             console.log("Fetching from:", url); // Debug log

//             const res = await fetch(url);

//             if (!res.ok) {
//                 throw new Error("HTTP " + res.status + " " + res.statusText);
//             }

//             const data = await res.json();

//             console.log("Models received:", data); // Debug log

//             // Clear and populate model dropdown
//             modelChoices.clearStore();

//             if (Array.isArray(data) && data.length > 0) {
//                 const choices = [
//                     { value: '', label: 'Select Your Model', selected: true },
//                     ...data.map(m => ({ value: String(m.id), label: m.name }))
//                 ];

//                 modelChoices.setChoices(choices, 'value', 'label', true);
//                 showFormGroup(modelGroup);
//                 modelChoices.enable();
//             } else {
//                 modelChoices.setChoices([
//                     { value: '', label: 'No models available', disabled: true, selected: true }
//                 ], 'value', 'label', true);
//                 showFormGroup(modelGroup);
//             }
//         } catch (err) {
//             console.error("Error fetching models:", err);
//             modelChoices.clearStore();
//             modelChoices.setChoices([
//                 { value: '', label: 'Error loading models', disabled: true, selected: true }
//             ], 'value', 'label', true);
//             showFormGroup(modelGroup);
//         }
//         updateFindButton();
//     });

//     // Progressive reveal listeners - Use native change events (they still fire with Choices.js)
//     modelSelect.addEventListener("change", function () {
//         console.log("Model selected:", this.value); // Debug log

//         if (this.value) {
//             showFormGroup(yearGroup);
//             yearChoices.enable();
//         } else {
//             hideFormGroup(yearGroup);
//             hideFormGroup(partsGroup);
//             hideFormGroup(conditionGroup);
//             yearChoices.disable();
//             partsChoices.disable();
//         }
//         updateFindButton();
//     });

//     yearSelect.addEventListener("change", function () {
//         console.log("Year selected:", this.value); // Debug log

//         if (this.value) {
//             showFormGroup(partsGroup);
//             partsChoices.enable();
//         } else {
//             hideFormGroup(partsGroup);
//             hideFormGroup(conditionGroup);
//             partsChoices.disable();
//         }
//         updateFindButton();
//     });

//     partsDropdown.addEventListener("change", function () {
//         console.log("Part selected:", this.value); // Debug log

//         if (this.value && !selectedParts.includes(this.value)) {
//             selectedParts.push(this.value);
//             createPartTag(this.value);
//             partsChoices.setChoiceByValue('');
//             showFormGroup(conditionGroup);
//             updateFindButton();
//         }
//     });

//     findBtn.addEventListener("click", function (e) {
//         if (findBtn.disabled) {
//             e.preventDefault();
//             return;
//         }

//         const conditionElement = document.querySelector(
//             'input[name="condition"]:checked'
//         );

//         if (!conditionElement) {
//             e.preventDefault();
//             alert("Please select a condition option");
//             return;
//         }

//         const searchData = {
//             make: makeSelect.value,
//             model: modelSelect.value,
//             year: yearSelect.value,
//             parts: selectedParts,
//             condition: conditionElement.value,
//         };

//         console.log("Search Data:", searchData);
//     });
// });

// // Pagination
// function setupPagination(gridId, paginationId, perPage = 6) {
//     const products = document.querySelectorAll(`#${gridId} .card`);
//     const totalPages = Math.ceil(products.length / perPage);
//     const pagination = document.getElementById(paginationId);

//     if (!pagination) return;

//     function showPage(page) {
//         products.forEach((product, i) => {
//             product.style.display =
//                 i >= (page - 1) * perPage && i < page * perPage
//                     ? "block"
//                     : "none";
//         });
//         pagination.querySelectorAll("button").forEach((btn, i) => {
//             btn.classList.toggle("active", i + 1 === page);
//         });
//     }

//     pagination.innerHTML = "";

//     for (let i = 1; i <= totalPages; i++) {
//         const btn = document.createElement("button");
//         btn.innerText = i;
//         btn.addEventListener("click", () => showPage(i));
//         pagination.appendChild(btn);
//     }

//     if (totalPages > 0) {
//         showPage(1);
//     }
// }

// // Call for both sections
// setupPagination("productGrid1", "pagination1");
// setupPagination("productGrid2", "pagination2");

// // Mobile Menu Functionality
// const burgerMenu = document.getElementById("burger-menu");
// const navMenu = document.getElementById("nav-menu");

// if (burgerMenu && navMenu) {
//     burgerMenu.addEventListener("click", function () {
//         burgerMenu.classList.toggle("active");
//         navMenu.classList.toggle("active");
//     });

//     const navLinks = document.querySelectorAll(".nav-menu a");
//     navLinks.forEach((link) => {
//         link.addEventListener("click", () => {
//             burgerMenu.classList.remove("active");
//             navMenu.classList.remove("active");
//         });
//     });

//     document.addEventListener("click", function (event) {
//         if (
//             !burgerMenu.contains(event.target) &&
//             !navMenu.contains(event.target)
//         ) {
//             burgerMenu.classList.remove("active");
//             navMenu.classList.remove("active");
//         }
//     });

//     window.addEventListener("resize", function () {
//         if (window.innerWidth > 768) {
//             burgerMenu.classList.remove("active");
//             navMenu.classList.remove("active");
//         }
//     });
// }

// // Bootstrap toast notifications
// document.addEventListener("DOMContentLoaded", function () {
//     const toastElList = [].slice.call(document.querySelectorAll(".toast"));
//     toastElList.map(function (toastEl) {
//         const toast = new bootstrap.Toast(toastEl, { delay: 4000 });
//         toast.show();
//     });
// });

// // Add CSS for Choices.js z-index fix
// const style = document.createElement('style');
// style.textContent = `
//     /* Fix any parent with overflow */
//     * {
//         overflow: visible !important;
//     }

//     body, html {
//         overflow-x: hidden !important;
//         overflow-y: auto !important;
//     }

//     /* Ensure choices dropdowns appear on top */
//     .choices {
//         position: relative !important;
//         margin-bottom: 1rem;
//     }

//     .choices__inner {
//         background-color: #fff;
//         border: 1px solid #ddd;
//         border-radius: 4px;
//         min-height: 44px;
//         padding: 7.5px 10px;
//     }

//     .choices__input {
//         background-color: #fff;
//     }

//     /* Make dropdown list appear above everything */
//     .choices__list--dropdown {
//         position: absolute !important;
//         z-index: 999999 !important;
//         top: 100% !important;
//         margin-top: 0 !important;
//         background: white !important;
//         border: 1px solid #ddd !important;
//         border-radius: 4px !important;
//         box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2) !important;
//         max-height: 300px !important;
//         overflow-y: auto !important;
//         width: 100% !important;
//     }

//     .choices[data-type*="select-one"] .choices__list--dropdown,
//     .choices[data-type*="select-multiple"] .choices__list--dropdown {
//         display: none;
//     }

//     .choices[data-type*="select-one"].is-open .choices__list--dropdown,
//     .choices[data-type*="select-multiple"].is-open .choices__list--dropdown {
//         display: block !important;
//         position: absolute !important;
//         z-index: 999999 !important;
//     }

//     .choices.is-open {
//         z-index: 999999 !important;
//     }
// `;
// document.head.appendChild(style);
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
    const makeSelect = document.getElementById("make");
    const modelSelect = document.getElementById("model");
    const yearSelect = document.getElementById("year");
    const partsDropdown = document.getElementById("parts-dropdown");
    const partsTagsContainer = document.getElementById("parts-tags");
    const findBtn = document.getElementById("find-btn");

    const modelGroup = document.getElementById("model-group");
    const yearGroup = document.getElementById("year-group");
    const partsGroup = document.getElementById("parts-group");
    const conditionGroup = document.getElementById("condition-group");

    let selectedParts = [];

    // helpers (keep your original animations)
    function showFormGroup(group) {
        group.classList.remove("hidden");
        setTimeout(() => group.classList.add("show"), 50);
    }
    function hideFormGroup(group) {
        group.classList.remove("show");
        setTimeout(() => group.classList.add("hidden"), 300);
    }

    function updateFindButton() {
        const hasBasicInfo =
            makeSelect.value && modelSelect.value && yearSelect.value;
        const hasParts = selectedParts.length > 0;
        findBtn.disabled = !(hasBasicInfo && hasParts);
    }

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
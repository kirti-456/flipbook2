const fileInput = document.getElementById('fileInput');
const generateFlipbookBtn = document.getElementById('generateFlipbook');
const flipbookContainer = document.getElementById('flipbook');
const prevPageBtn = document.getElementById('prevPage');
const nextPageBtn = document.getElementById('nextPage');

let pages = [];
let currentIndex = 0;

// Enable generate button when files are selected
fileInput.addEventListener('change', () => {
    generateFlipbookBtn.disabled = fileInput.files.length === 0;
});

// Generate flipbook
generateFlipbookBtn.addEventListener('click', async () => {
    const files = Array.from(fileInput.files);
    if (files.length === 0) return;

    flipbookContainer.innerHTML = '';
    pages = [];
    currentIndex = 0;

    for (const file of files) {
        if (file.type === 'application/pdf') {
            await processPDF(file);
        } else if (file.type.startsWith('image/')) {
            processImage(file);
        }
    }

    updateFlipbook();
    updateNavigationButtons();
});

// Process PDF file
async function processPDF(file) {
    const fileReader = new FileReader();
    fileReader.onload = async (e) => {
        const pdfData = new Uint8Array(e.target.result);
        const pdf = await pdfjsLib.getDocument(pdfData).promise;

        for (let pageNum = 1; pageNum <= pdf.numPages; pageNum++) {
            const page = await pdf.getPage(pageNum);
            const canvas = document.createElement('canvas');
            const context = canvas.getContext('2d');
            const viewport = page.getViewport({ scale: 1.5 });

            canvas.width = viewport.width;
            canvas.height = viewport.height;
            await page.render({ canvasContext: context, viewport }).promise;

            const img = document.createElement('img');
            img.src = canvas.toDataURL();
            img.alt = `Page ${pageNum}`;

            const pageDiv = createFlipbookPage(img);
            pages.push(pageDiv);
            flipbookContainer.appendChild(pageDiv);
        }
    };
    fileReader.readAsArrayBuffer(file);
}

// Process image file
function processImage(file) {
    const img = document.createElement('img');
    img.alt = `Image: ${file.name}`;

    const fileReader = new FileReader();
    fileReader.onload = (e) => {
        img.src = e.target.result;

        const pageDiv = createFlipbookPage(img);
        pages.push(pageDiv);
        flipbookContainer.appendChild(pageDiv);
    };
    fileReader.readAsDataURL(file);
}

// Create flipbook page element
function createFlipbookPage(content) {
    const pageDiv = document.createElement('div');
    pageDiv.className = 'flipbook-page';
    pageDiv.appendChild(content);
    return pageDiv;
}

// Update flipbook display
function updateFlipbook() {
    pages.forEach((page, index) => {
        page.style.zIndex = pages.length - index;
        page.classList.remove('flipped');
        if (index < currentIndex) {
            page.classList.add('flipped');
        }
    });
}

// Update navigation buttons
function updateNavigationButtons() {
    prevPageBtn.disabled = currentIndex === 0;
    nextPageBtn.disabled = currentIndex === pages.length - 1;
}

// Navigation buttons
prevPageBtn.addEventListener('click', () => {
    if (currentIndex > 0) {
        currentIndex--;
        updateFlipbook();
        updateNavigationButtons();
    }
});

nextPageBtn.addEventListener('click', () => {
    if (currentIndex < pages.length - 1) {
        currentIndex++;
        updateFlipbook();
        updateNavigationButtons();
    }
});

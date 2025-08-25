const loadJsPDF = () => {
    const script = document.createElement("script");
    script.src = "https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js";
    script.onload = () => console.log("jsPDF loaded");
    document.head.appendChild(script);
};
loadJsPDF();

let selectedSeats = [];

function showSeatSelection(onDoneCallback) {
    selectedSeats = [];
    const modal = document.createElement("div");
    modal.id = "seatSelectionModal";
    modal.style.position = "fixed";
    modal.style.top = "0";
    modal.style.left = "0";
    modal.style.width = "100%";
    modal.style.height = "100%";
    modal.style.backgroundColor = "rgba(0, 0, 0, 0.5)";
    modal.style.display = "flex";
    modal.style.justifyContent = "center";
    modal.style.alignItems = "center";
    modal.style.zIndex = "2000";
    modal.style.color = "black";

    const content = document.createElement("div");
    content.style.backgroundColor = "#fff";
    content.style.padding = "20px";
    content.style.borderRadius = "10px";
    content.style.textAlign = "center";
    content.style.width = "500px";

    // Legend and seat creation code remains the same...

    const doneButton = document.createElement("button");
    doneButton.textContent = "Done";
    doneButton.style.backgroundColor = "blue";
    doneButton.style.color = "white";
    doneButton.style.padding = "10px";
    doneButton.style.border = "none";
    doneButton.style.borderRadius = "5px";
    doneButton.style.marginTop = "20px";

    doneButton.addEventListener("click", () => {
        if (selectedSeats.length === 0) {
            alert("Please select at least one seat.");
            return;
        }
        modal.remove();
        if (typeof onDoneCallback === 'function') {
            onDoneCallback();
        }
    });

    content.appendChild(doneButton);
    modal.appendChild(content);
    document.body.appendChild(modal);
}

// Initialize Livewire event listeners
document.addEventListener('livewire:init', () => {
    Livewire.on('open-seat-selection', () => {
        showSeatSelection(() => {
            Livewire.dispatch('seats-selected', { seats: selectedSeats });
        });
    });
});
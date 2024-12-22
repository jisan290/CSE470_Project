
function manageProfile() {
    alert("Navigate to the Profile Management page.");
}

function searchParking() {
    const location = document.getElementById("location-search").value;
    if (location) {
        alert(`Searching parking spaces near: ${location}`);
    } else {
        alert("Please enter a location to search.");
    }
}

function listParking() {
    alert("Navigate to the List Parking Space page.");
}

function viewReservations() {
    alert("Navigate to the Reservations page.");
}

function leaveReview() {
    alert("Navigate to the Ratings and Reviews page.");
}

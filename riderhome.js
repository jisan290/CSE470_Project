// JavaScript Functions

// Manage Profile Function
function manageProfile() {
    alert("Navigate to the Profile Management page.");
}

// Search Parking Function
function searchParking() {
    const location = document.getElementById("location-search").value;
    if (location) {
        alert(`Searching parking spaces near: ${location}`);
        // Add logic to integrate map and fetch results
    } else {
        alert("Please enter a location to search.");
    }
}

// List Parking Space Function
function listParking() {
    alert("Navigate to the List Parking Space page.");
}

// View Reservations Function
function viewReservations() {
    alert("Navigate to the Reservations page.");
}

// Leave Review Function
function leaveReview() {
    alert("Navigate to the Ratings and Reviews page.");
}
// const parkingSpots = [
//     { lat: 23.8103, lng: 90.4125, title: "Parking Spot 1" },
//     { lat: 23.8203, lng: 90.4225, title: "Parking Spot 2" }
// ];

// parkingSpots.forEach(spot => {
//     L.marker([spot.lat, spot.lng]).addTo(map)
//         .bindPopup(spot.title);
// });


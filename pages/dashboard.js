async function checkHeartRateCharacteristics() {
    try {
        const device = await navigator.bluetooth.requestDevice({
            acceptAllDevices: true,
            optionalServices: ['heart_rate']
        });

        const server = await device.gatt.connect();
        const service = await server.getPrimaryService('heart_rate');

        const characteristics = await service.getCharacteristics();
        console.log("✅ Available Heart Rate Characteristics:");
        characteristics.forEach(char => console.log(char.uuid));

    } catch (error) {
        console.error("❌ Error fetching heart rate characteristics:", error);
        alert("Failed to fetch heart rate characteristics! Make sure your smartwatch is connected.");
    }
}

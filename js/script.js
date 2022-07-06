$(document).ready(function () {
    $("#submitButton").on("click", () => handleClickEvent());
});

async function handleClickEvent() {
    let data = await _fetchDataFromURL();
    drawTableLayout();
    $("#table").DataTable({
        data: data,
        columns: [
            {data: 'id'},
            // {data: 'applicable_at'},
            {data: 'applicable_for'},
            {data: 'data_item'},
            {data: 'value'},
            // {data: 'generated_time'},
        ]
    });
}

function drawTableLayout() {
    var tableHtml = "<thead><tr id='heading-row'>\n" +
        "                <th>Id</th>\n" +
        // "                <th>Applicable At</th>\n" +
        "                <th>Applicable For</th>\n" +
        "                <th>Item</th>\n" +
        "                <th>Value</th>\n" +
        // "                <th>Generated Time</th>\n" +
        "            </tr></thead><tbody id='tbody'></tbody>";
    $("#table").append(tableHtml);
}

function _fetchDataFromURL() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'get',
            dataType: 'json',
            contentType: 'application/json',
            url: 'controllers/front_controller.php',
            success: resolve,
            error: reject
        });
    });

}
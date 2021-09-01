console.log("Loaded");
function search(content) {
    console.log(content);
    fetchSearchData(content);
}

function fetchSearchData(content) {
    fetch('/Controllers/search.php', {
        method: 'POST',
        body: new URLSearchParams('content=' + content)
    })
        .then(res => res.json())
        .then(res => viewSearchResult(res))
        .catch(e => console.error('Error: ' + e))
}

function viewSearchResult(data){
    const dataViewer = document.getElementById("dataViewer");

    dataViewer.innerHTML = "";

    for(let i = 0; i < data.length; i++) {
        let li=document.createElement("li");
        li.innerHTML = data[i]["content"];

        if(i % 2 == 0) {
            li.style.backgroundColor = "white";
            li.style.height = "5em";
            li.style.color = "black";
            li.style.marginBottom = "1em";
        } else {
            li.style.backgroundColor = "floralwhite";
            li.style.height = "5em";
            li.style.color = "black";
            li.style.marginBottom = "1em";
        }
        dataViewer.appendChild(li);
        console.log(data[i]);
    }
}
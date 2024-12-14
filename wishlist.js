let wishList = [];

function setup() 
{
    let destination = document.querySelectorAll(".but");
    for (let i = 0; i < destination.length; i++)
    {
        destination[i].onclick = function(e) {
            addItem(e);
        }
    }
}

function addItem (e) {
    let destinationId = e.target.getAttribute("id");
    if(!wishList.find(element => element === destinationId)){
        let destinationDiv = document.getElementById("destination" + destinationId);

        let wishDiv = document.createElement("div");
        wishDiv.setAttribute("id", "wish" + destinationId);
        wishDiv.setAttribute("class", "destination");
        wishDiv.setAttribute("style", "margin-bottom: 10px;")
        wishDiv.innerHTML += destinationDiv.innerHTML;
        let removeBtn = document.createElement("input");
        removeBtn.setAttribute("id", "remove" + destinationId);
        removeBtn.setAttribute("type", "button");
        removeBtn.setAttribute("value", "Remove");
        // removeBtn.setAttribute("class", "removebut");
        removeBtn.onclick = () => removeItem(destinationId);
        wishDiv.appendChild(removeBtn);

        let aside = document.getElementById("wishlist");
        aside.appendChild(wishDiv);

        wishList.push(destinationId);
    }
}

function removeItem(destinationId) {
    document.getElementById("wish" + destinationId).remove();
    wishList = wishList.filter(element => element !== destinationId)
}

window.addEventListener("load", setup);
class LikeButton extends React.Component{

    render(){
    return <button className="btn btn-success"> Click </button>
       //return React.createElement("button", {className:"btn"}, "click")
    }
}


const elem = document.getElementById("test")
ReactDOM.render(React.createElement(LikeButton), elem)
// document.querySelectorAll("div#test").forEach(function(div){
//    ReactDOM.render(React.createElement(LikeButton), div) 
// })
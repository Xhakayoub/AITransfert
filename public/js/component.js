console.log("i'am here");


class divComponent extends React.Component {
    constructor(props){
        super(props);

        this.state = {
            title : props.title || "Random",
            positionX : props.positionX || 0,
            positionY : props.positionX || 0 
        }
    }
    
    render (){ 
        return React.createElement(
        'button', 
        { className : "btn btn-outline-primary" }, 
        "Random"
        ) ;
    }
}

document.querySelectorAll('div.react').forEach(function(div){
    ReactDOM.render(React.createElement(divComponent), div);
})
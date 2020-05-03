class Card extends React.Component {

    state = {
        title: this.props.title || "",
        description: this.props.description || "",
        href: this.props.href || "",
    }


    render() {
        // var elem = document.getElementById("cards");
        // var titre = elem.dataset.title.split(',');
        // var desc = elem.dataset.description.split(',');
        // var position = "";
        // var div = ""

        return (<a href={this.state.href} className={"list-group-item bg-dark text-white list-group-item-action flex-column align-items-start w-100"}>
            <div className="d-flex w-100 justify-content-between">
                <h5 className="mb-1">{this.state.title}</h5>
                <small>3 days ago</small>
            </div>
            <p className="mb-1">{this.state.description}</p>
            <small>Donec id elit non mi porta.</small>
        </a>)



    }
}


// const elem = document.getElementById("cards");

// ReactDOM.render(React.createElement(Card), elem)

export default Card;
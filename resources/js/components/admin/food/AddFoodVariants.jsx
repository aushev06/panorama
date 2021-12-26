import React from 'react';
import ReactDOM from 'react-dom';

import Form from './_form';

const templateVariant = {id: null, name: '', price: null, old_price: null, is_visible: null, sort: null}
const ELEMENT_ID = "react-add-variants";

class AddFoodVariants extends React.Component {
    constructor(props) {
        super(props);
        this.state = {
            variants: [templateVariant]
        }
    }

    componentDidMount() {
        const element = $("#" + ELEMENT_ID);
        const json = JSON.parse(element.attr('data-foods'));

        this.setState({
            variants: json.length > 0 ? json : [templateVariant]
        })
    }

    addVariants() {
        let variants = _.cloneDeep(this.state.variants);
        variants.push(templateVariant);

        this.setState({
            variants
        });
    }

    render() {
        return (
            <div className={"row"}>
                {this.state.variants.map((item, key) => {
                    return (<Form {...item} idx={key} key={key} addVariant={this.addVariants.bind(this)}/>)
                })}
            </div>
        )
    }
}

if (document.getElementById(ELEMENT_ID)) {
    ReactDOM.render(<AddFoodVariants/>, document.getElementById(ELEMENT_ID));
}

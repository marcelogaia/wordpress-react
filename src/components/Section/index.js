import React, { Component } from 'react';

class Section extends Component {
	render() {
		return (
			<div>
				Section
				{this.props.children}
			</div>	
		);
	}
}

export default Section;
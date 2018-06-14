import React, { Component } from 'react';
import "./Section.css";

class Section extends Component {
	render() {
		return (
			<div className={`Section ${this.props.className || ""}`}>
				<h2>{this.props.title}</h2>
				<hr />
				<div className="Section-inner">
					{this.props.children}
				</div>
			</div>
		);
	}
}

export default Section;
import React, { Component } from 'react';
import bannerImg from './banner.jpg';
import "./Banner.css";

class Banner extends Component {
	render() {
		return (
		<div className="Banner">
			<img src={bannerImg} />
		</div>
		);
	}
}

export default Banner;
import React, { Component } from 'react';
import "./Testimonials.css"
import { Grid, Row, Col } from "react-bootstrap";
import noavatar from "./noavatar.jpg";

class Testimonials extends Component {
	render() {
		return (
			<div className="Testimonials">
				<Grid>
                    <Row>
                        <Col xs={12} sm={6} md={4}>
                            <img src={noavatar} alt="Edy Castro" />
                            <blockquote>
                                <h3>Edy Castro said:</h3>
                                <p>Marcelo is a good player! He really knows how to guide
                                the project in the best way, so it's easy to work with him.</p>
                            </blockquote>
                        </Col>
                        <Col xs={12} sm={6} md={4}>
                            <img src={noavatar} alt="Edy Castro" />
                            <blockquote>
                                <h3>Edy Castro said:</h3>
                                <p>Marcelo is a good player! He really knows how to guide
                                the project in the best way, so it's easy to work with him.</p>
                            </blockquote>
                        </Col>
                        <Col xs={12} sm={6} md={4}>
                            <img src={noavatar} alt="Edy Castro" />
                            <blockquote>
                                <h3>Edy Castro said:</h3>
                                <p>Marcelo is a good player! He really knows how to guide
                                the project in the best way, so it's easy to work with him.</p>
                            </blockquote>
                        </Col>
                    </Row>
                </Grid>
			</div>
		);
	}
}

export default Testimonials;
import React, { Component } from "react";
import "./Contact.css";
import { Grid, Row, Col } from "react-bootstrap";
import ContactForm from "../../ContactForm";

class Contact extends Component {
    render() {
        return (
            <div className="Contact">
                <Grid>
                    <Row>
                        <Col xs={12} sm={6}>
                            <h3>Thank you for coming here!</h3>
                            <p>
                                If you want, we can talk about your <u>IT problems</u> and find the best solutions for <u>your company or project</u>.
                            </p>
                            <p>
                                Keep in touch with me through the contact form or mailto: <a href="mailto:marcelo@marcelogaia.com.br">marcelo@marcelogaia.com.br</a>
                            </p>
                        </Col>
                        <Col xs={12} sm={6}>
                            <ContactForm />
                        </Col>
                    </Row>
                </Grid>
            </div>
        );
    }
}

export default Contact;
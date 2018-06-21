import React, { Component } from "react";
import "./ProjectPage.css";
import axios from "axios";
import { Grid, Col, Row } from "react-bootstrap";


class ProjectPage extends Component {
    constructor(props) {
        super(props);

        this.state = {
            projectId : null,
            projectInfo : {
                id : "",
                name : "",
                description : "",
                image : "",
            }
        };
    }

    componentDidUpdate() {
        axios.get("http://marcelogaia.com.br/blog/wp-json/wp/v2/jetpack-portfolio/" + this.state.projectId + "?_embed")
        .then( response => {
            const p = response.data,
                imageInfo = p._embedded["wp:featuredmedia"];
            
            let image = "";

            if (imageInfo !== undefined) image = imageInfo[0].source_url;

            const project = {
                id : p.id,
                name : p.title.rendered,
                description : p.content.rendered,
                image : image
            }

            // TODO: MAJOR PROBLEM
            if(JSON.stringify(this.state.projectInfo) !== JSON.stringify(project))
                this.setState({projectInfo : project});
        })
        .catch(error => console.error(error));
    }

    render () {
        return (
            <div className="ProjectPage">
                <Grid className="info" fluid={true}>
                    <Row>
                        <Col xs={12}>
                            <h2>{this.state.projectInfo.name}</h2>
                        </Col>
                    </Row>
                    <Row>
                        <Col xs={12} sm={6} className="carousel">
                            {/* Carousel */}
                            <img src={this.state.projectInfo.image} alt="" />
                        </Col>
                        <Col xs={12} sm={6}>
                            <p>{this.state.projectInfo.description}</p>
                            
                        </Col>
                    </Row>
                </Grid>
                <span className="closeBtn" onClick={this.props.closeModal}></span>
            </div>
        )
    }
}

export default ProjectPage
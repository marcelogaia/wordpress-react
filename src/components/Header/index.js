import React, { Component } from 'react';
import { Nav, Navbar, NavItem } from 'react-bootstrap';
import logo from "./logo-marcelo-gaia-header.png";
import { Link } from "react-router-dom";
import "./Header.css";

class Header extends Component {

	render() {
		return ( 
			<div className="Header">
				<Navbar className="Header-navbar" fixedTop>
					<Navbar.Header>
						<Navbar.Brand>
							<Link to="#home"><img src={logo} className="logo" alt="Marcelo Gaia" /></Link>
						</Navbar.Brand>
						<Navbar.Toggle className="Header-toggle" />
					</Navbar.Header>
					<Navbar.Collapse>
						<Nav pullRight className="Header-nav">
							<NavItem eventKey={1} href="#">
								Blog
							</NavItem>
							<NavItem eventKey={2} href="#">
								About
							</NavItem>
							<NavItem eventKey={3} href="#">
								Projects
							</NavItem>
							<NavItem eventKey={4} href="#">
								Contact
							</NavItem>
						</Nav>
					</Navbar.Collapse>
				</Navbar>
			</div>
		);
	}
}

export default Header;
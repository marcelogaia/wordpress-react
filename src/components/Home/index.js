import React, { Component } from 'react';
import './Home.css';
import Section from "../Section";
import Header from "../Header";
import Banner from "./Banner";
import About from "./About";

class Home extends Component {
  render() {
    return (
      <div className="Home">
        <Header />
        <Banner />
        <Section title="About me" name="about">
          <About />
        </Section>
      </div>
    );
  }
}

export default Home;

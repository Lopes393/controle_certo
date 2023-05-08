"use client"; // this is a client component 👈🏽

import Image from "next/image";
import React, { useEffect, useState } from "react";

type API = {
  id: number;
  name: number;
  cpf: string;
  type: string;
  description: string;
};

export default function Home() {
  const [contacts, setContats] = useState<any>([]);
  const [contact, setContact] = useState<any>({});
  const [searchString, setSearchString] = useState("");
  const [apis, setApis] = useState<API[]>([]);

  const fakeContacts = [
    { id: 1, name: "Linus Torvalds", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-1234" },
    { id: 2, name: "Robert Cecil Martin", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-1235" },
    { id: 3, name: "Tim Berners-Lee", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-2345" },
    { id: 4, name: "Vaughn Vernon", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-3462" },
    { id: 5, name: "Rodrigo Branas", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-2341" },
    { id: 6, name: "Alan Turing", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-6432" },
    { id: 7, name: "Rasmus Lerdorf", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-3215" },
    { id: 8, name: "Elon Musk", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-8765" },
    { id: 9, name: "Bjarne Stroustrup", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-3233" },
    { id: 10, name: "Andrew Yu e Jolly Chen", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-2222" },
    { id: 11, name: "Bitter", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-4511" },
    { id: 12, name: "Murilo Lopes", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-2211" },
    { id: 13, name: "Elon Musk", cpf: "123.456.789-11", type: "Celular", description: "(64) 99995-4422" },
  ];

  useEffect(() => {
    setContact(fakeContacts[0]);
    setContats(fakeContacts);
  }, []);

  useEffect(() => {
    const fetchData = async () => {
      const response = await fetch("http://localhost:8000/controle_certo/");
      const data = await response.json();
      setApis(data);
    };

    fetchData();
  }, []);

  const handleSearch = (e: any) => {
    setSearchString(e.target.value);
  };
  const filteredContacts = contacts.filter((contact: any) =>
    contact.name.toLowerCase().includes(searchString.toLowerCase())
  );

  function handleDetail(contactDetail: any) {
    setContact(contactDetail);
  }

  return (
    <main className="flex min-h-screen flex-col items-center justify-between">
      <div className="content">
        <div className="contacts">
          <div className="search">
            <input
              type="text"
              className="input"
              placeholder="Search all contacts"
              onChange={handleSearch}
              value={searchString}
            />
          </div>
          <div className="itens">
            {filteredContacts.map((itemContact: any) => (
              <div className="item" key={itemContact.id} onClick={() => handleDetail(itemContact)}>
                <img src="https://i.imgur.com/Y326hv0.png" alt="" />
                {itemContact.name}
              </div>
            ))}
          </div>
        </div>
        <div className="detail">
          <div className="card">
            <div className="contact">
              <img src="https://i.imgur.com/Y326hv0.png" alt="" />
              <h2>{contact?.name}</h2>
            </div>
            <p className="cpf">CPF: {contact?.cpf}</p>
            <p className="phone-number">Tipo: {contact?.type}</p>
            <p className="description">Contato: {contact.description}</p>
          </div>
        </div>
        <div className="buttons">
          <button className="alter">-</button>
          <button className="save">+</button>
        </div>
      </div>
    </main>
  );
}

"use client"; // this is a client component 👈🏽

import Image from "next/image";
import React, { useEffect, useState } from "react";
import CustomButton from "./components/CustomButton";
import CustomInput from "./components/CustomInput";

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

  useEffect(() => {
    getPeaple();
  }, []);

  const handleSearch = (e: any) => {
    setSearchString(e.target.value);
  };
  const filteredContacts = contacts.filter((contact: any) =>
    contact.name.toLowerCase().includes(searchString.toLowerCase())
  );

  async function handleDetail(contactDetail: any) {
    getPeapleById(contactDetail.id);
  }

  async function getPeapleById(id: number) {
    const response = await fetch(`http://localhost:8000/public/index/pessoas/${id}`);
    const data = await response.json();
    setContact(data);
  }

  async function getPeaple() {
    const response = await fetch("http://localhost:8000/public/index/pessoas");
    const data = await response.json();
    setContats(data);
  }

  return (
    <main className="flex min-h-screen flex-col items-center justify-between">
      <div className="content">
        <div className="contacts">
          <div className="search">
            <CustomInput
              placeholder="Pesquisar Contatos"
              value={searchString}
              onChange={handleSearch}
              className="input"
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
        {contact.id ? (
          <div className="detail">
            <div className="card">
              <div className="contact">
                <img src="https://i.imgur.com/Y326hv0.png" alt="" />
                <h2>{contact?.name}</h2>
              </div>
              <p className="cpf">CPF: {contact?.cpf}</p>
              {contact?.contatos?.map((contato: any) => (
                <>
                  <p className="phone-number">Tipo: {contato?.type}</p>
                  <p className="description">Contato: {contato.description}</p>
                </>
              ))}
            </div>
          </div>
        ) : (
          <></>
        )}

        <div className="buttons">
          <CustomButton className="custom-button-delete" text="-" variant="primary" />
          <CustomButton className="custom-button-alter" text="/" variant="primary" />
          <CustomButton className="custom-button-save" text="+" variant="primary" />
        </div>
      </div>
    </main>
  );
}

import { GoogleGenerativeAI } from '@google/generative-ai';

const businessInfo = `

Tentang Sawala:
Sawala adalah platform media sosial berbasis web yang dirancang untuk memfasilitasi diskusi yang lebih mudah dan interaktif antar pengguna. Sawala bertujuan untuk menciptakan lingkungan diskusi yang inklusif, produktif, dan nyaman bagi semua pengguna.

Fitur Utama:
1. **Feed Interaktif**  
   - Pengguna dapat berbagi pemikiran, artikel, dan berdiskusi dengan komunitas yang aktif.  
   - Mendukung berbagai jenis konten, seperti teks, gambar, dan tautan.  

2. **Kolaborasi dan Diskusi**  
   - Membuka ruang bagi pengguna untuk bertukar ide dan berpendapat dalam suasana yang mendukung.  
   - Memungkinkan interaksi dalam komunitas berdasarkan minat yang sama.  

3. **Keamanan dan Kenyamanan**  
   - Moderasi diskusi untuk memastikan lingkungan yang sehat dan kondusif.  
   - Kebijakan anti-konten negatif untuk menjaga keamanan pengguna.  

Panduan Penggunaan:
- Pengguna dapat memulai diskusi dengan membuat postingan di feed.  
- Setiap pengguna bisa memberikan komentar postingan.  

Nada Jawaban AI:
- **Singkat dan informatif**  
- **Ramah dan profesional**  
- **Selalu membantu pengguna dalam memahami fitur Sawala**  

Contoh Tanya Jawab:
**Q:** Apa itu Sawala?  
**A:** Sawala adalah platform media sosial berbasis web yang memfasilitasi diskusi dan kolaborasi interaktif.  

**Q:** Apa saja fitur utama Sawala?  
**A:** Sawala memiliki feed interaktif, alat untuk diskusi dan kolaborasi, serta fitur keamanan untuk kenyamanan pengguna.  

**Q:** Bagaimana cara memulai diskusi di Sawala?  
**A:** Pengguna dapat membuat postingan di feed dan berinteraksi melalui komentar atau fitur lainnya.  

Silakan tanyakan jika Anda membutuhkan bantuan lebih lanjut terkait Sawala!  
`;

const API_KEY = 'AIzaSyCfx3FjrvmLqx4G_AVf7tDlddpH9oSLmbk';
const genAI = new GoogleGenerativeAI(API_KEY);
const model = genAI.getGenerativeModel({
	model: 'gemini-1.5-flash',
	systemInstruction: businessInfo,
});

let messages = {
	history: [],
};

async function sendMessage() {
	console.log(messages);
	const userMessage = document.querySelector('.chat-window input').value;

	if (userMessage.length) {
		try {
			document.querySelector('.chat-window input').value = '';
			document.querySelector('.chat-window .chat').insertAdjacentHTML(
				'beforeend',
				`
                <div class="bg-white p-4 border-brutal shadow-brutal rounded-lg my-3 w-fit ml-auto">
                    <p class="text-gray-700 text-end">${userMessage}</p>
                </div>
            `
			);

			document.querySelector('.chat-window .chat').insertAdjacentHTML(
				'beforeend',
				`
                <div class="loader bg-white p-4 border-brutal shadow-brutal rounded-lg my-3 inline-block"></div>
            `
			);

			const chat = model.startChat(messages);

			let result = await chat.sendMessageStream(userMessage);

			document.querySelector('.chat-window .chat').insertAdjacentHTML(
				'beforeend',
				`
                <div class="model bg-white p-4 border-brutal shadow-brutal rounded-lg my-3 inline-block">
                    <p class="text-start"></p>
                </div>
            `
			);

			let modelMessages = '';

			for await (const chunk of result.stream) {
				const chunkText = chunk.text();
				modelMessages = document.querySelectorAll(
					'.chat-window .chat div.model'
				);
				modelMessages[modelMessages.length - 1]
					.querySelector('p')
					.insertAdjacentHTML(
						'beforeend',
						`
                ${chunkText}
            `
					);
			}

			messages.history.push({
				role: 'user',
				parts: [{ text: userMessage }],
			});

			messages.history.push({
				role: 'model',
				parts: [
					{
						text: modelMessages[modelMessages.length - 1].querySelector('p')
							.innerHTML,
					},
				],
			});
		} catch (error) {
			document.querySelector('.chat-window .chat').insertAdjacentHTML(
				'beforeend',
				`
                <div class="error bg-white p-4 border-brutal shadow-brutal rounded-lg">
                    <p>The message could not be sent. Please try again.</p>
                </div>
            `
			);
		}

		document.querySelector('.chat-window .chat .loader').remove();
	}
}

document
	.querySelector('.chat-window .input-area button')
	.addEventListener('click', () => sendMessage());

document.querySelector('.chat-button').addEventListener('click', () => {
	document.querySelector('body').classList.add('chat-open');
});

document
	.querySelector('.chat-window button.close')
	.addEventListener('click', () => {
		document.querySelector('body').classList.remove('chat-open');
	});

export default function Dashboard() {
    return (
        <div className="max-w-3xl mx-auto p-8 bg-white rounded-lg shadow-md mt-16">
            <h1 className="text-3xl font-semibold text-gray-800 mb-6">
                Welcome to Your Dashboard
            </h1>
            <form method="get" action="/logout">
                <button
                    type="submit"
                    className="mt-4 bg-red-600 hover:bg-red-700 transition-colors duration-300 text-white font-semibold px-6 py-2 rounded shadow-md"
                >
                    Logout
                </button>
            </form>
        </div>
    );
}
